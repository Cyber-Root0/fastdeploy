/*
 * Copyright (c) 2024 Bruno Venancio Alves
 *
 * Author: Bruno Venancio Alves
 * Email: boteistem@gmail.com
 *
 * Permission is granted to use, modify, and distribute this software with
 * acknowledgment of the original author. This notice must not be removed
 * or altered from any source distribution.
 */
using Renci.SshNet;
using FastDeploy.app.Params;
using FastDeploy.app.Factory;
using FastDeploy.app.service;
namespace FastDeploy.app
{
    /// <summary>
    /// SSH: Server tunnel
    /// </summary>
    class SSHClient
    {
        private Deploy deploy { get; set; }
        public SSHClient(Deploy deploy)
        {
            this.deploy = deploy;
        }
        /// <summary>
        /// Main method to init the tunnel and create port redirect
        /// </summary>
        public void execute()
        {
            using (SshClient client = this.getConnection())
            {
                try
                {
                    ForwardedPortRemote portForwarding = this.createPort(this.deploy);
                    client.Connect();
                    this.startDeploy(client);
                    client.AddForwardedPort(portForwarding);
                    if (client.IsConnected)
                    { 
                        Logger.info("Conexão com o servidor estabilizada.");
                        Logger.info("Deploy iniciado...");
                        portForwarding.Start();
                        Browser.redirect(deploy.domain);
                    }
                    var resetEvent = new System.Threading.ManualResetEvent(false);
                        Console.CancelKeyPress += (sender, e) =>
                        {
                            e.Cancel = true;
                            resetEvent.Set();
                        };
                    resetEvent.WaitOne();
                    portForwarding.Stop();
                }
                catch (Exception e)
                {
                    Logger.info(e.Message);
                }
            }
        }
        /// <summary>
        /// Start command to create nginx application/domain
        /// </summary>
        /// <param name="sshclient"></param>
        private void startDeploy(SshClient sshclient){
            uint rport = RemotePortForwarding.getAvailablePort();
            string domain = deploy.domain;
            var output = sshclient.RunCommand($"sudo /var/www/fastdeploy/bin/fastdeploy deploy -r {rport} -s {domain}");
            if (output.Result == "success"){
                Logger.info("SSL: Certificado instalado com sucesso");
            }else{
                throw new Exception("Ocorreu um erro ao iniciar o deploy.");
            }
        }
        /// <summary>
        /// Create SSHClient with default authentication
        /// </summary>
        /// <returns></returns>
        private SshClient getConnection()
        {
            Logger.info("Ativando criptografia...");
            string ip = Config.getRemoteHost();
            string pwd = Config.getRemoteToken();
            string user = Config.getRemoteUser();
            return new SshClient(ip, user, pwd);
        }
        /// <summary>
        /// Handle Remote port forward
        /// </summary>
        /// <param name="deploy"></param>
        /// <returns></returns>
        private ForwardedPortRemote createPort(Deploy deploy)
        {   
            uint localPort = (uint)deploy.localPort;
            ForwardedPortRemote portForward = RemotePortForwarding.create(deploy.localhost, localPort);
            portForward.Exception += (sender, eventArgs) =>
           {
               Logger.info("Servidor HTTP não detectado, inicie um servidor http(s) na porta " + localPort);
           };
            portForward.RequestReceived += (sender, eventArgs) =>
            {
                Logger.info("Novo acesso detectado, informações salvas no log");
            };
            return portForward;
        }
    }
}