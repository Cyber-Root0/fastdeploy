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
using FastDeploy.app;
using RestSharp;
namespace FastDeploy.app.service
{
    /// <summary>
    /// Available Interface
    /// </summary>
    class Available
    {
        public int port { get; set; }
    }
    /// <summary>
    /// Make request to the server and get the
    /// available input port
    /// </summary>
    class PortsAvailable
    {
        private string baseurl { get; set; } = "";
        private RestClient restclient { get; set; }
        public PortsAvailable()
        {
            var options = new RestClientOptions(Config.getServiceUrl());
            this.restclient = new RestClient(options);
        }
        /// <summary>
        /// Main Execute
        /// </summary>
        /// <returns></returns>
        public int execute()
        {
                var request = new RestRequest("ports/available", Method.Get);
                var response = this.restclient.Execute<Available>(request);
                if (response.IsSuccessful)
                {

                    int port = response.Data.port;
                    return port;
                }
                else
                {
                    throw new Exception(@"Não foi possivel se comunicar com a api, envie uma mensagem para o suporte. (18) 99747-9949");
                }
        }
    }
}