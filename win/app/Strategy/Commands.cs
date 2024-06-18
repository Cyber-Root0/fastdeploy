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
using FastDeploy.app.Params;
using FastDeploy.app;
using PowerArgs;
namespace FastDeploy.app.Strategy
{
    /// <summary>
    /// Strategy for commands handle
    /// </summary>
    class Commands
    {
        [HelpHook, ArgShortcut("-ajuda"), ArgDescription("Shows this help")]
         public bool Help { get; set; }
        [ArgActionMethod, ArgDescription("Inicia um deploy temporário")]
        /// <summary>
        /// Deploy action
        /// </summary>
        /// <param name="inputs"></param>
        public void deploy(Deploy inputs)
        {
            SSHClient client = new SSHClient(inputs);
            client.execute();
        }
    }
}