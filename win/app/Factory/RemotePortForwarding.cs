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
using FastDeploy.app;
using FastDeploy.app.service;
namespace FastDeploy.app.Factory{
    /// <summary>
    /// Create ForwardedPortRemote with values
    /// </summary>
    class RemotePortForwarding{
        private static uint porta{get;set;} = 0;
        /// <summary>
        /// Create method
        /// </summary>
        /// <param name="lhost"></param>
        /// <param name="localPort"></param>
        /// <returns>ForwardedPortRemote</returns>
        public static ForwardedPortRemote create(string lhost, uint localPort){
            string rhost =  Config.getRemoteHost();
            uint rport =  getAvailablePort();
            if (rhost==""){
                throw new Exception("Host remoto não pode ser vazio");
            }
            return new ForwardedPortRemote(rhost, rport, lhost, localPort);
        }
        /// <summary>
        /// Get the available from server by api call
        /// </summary>
        /// <returns></returns>
        public static uint getAvailablePort(){
            if (porta!=0){
                return porta;
            }
            PortsAvailable serviceDNS = new PortsAvailable();
            int port = serviceDNS.execute(); 
            porta = (uint) port;
            return porta;
        }
    }
}