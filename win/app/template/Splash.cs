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
using System.Reflection.Metadata.Ecma335;
namespace  FastDeploy.app.template
{
    /// <summary>
    /// Splash inicialization
    /// </summary>
    class Splash{
        /// <summary>
        /// Main execute
        /// </summary>
        public void execute(){
            Console.WriteLine(@"
        ███████╗ █████╗ ███████╗████████╗    ██████╗ ███████╗██████╗ ██╗      ██████╗ ██╗   ██╗    ██╗   ██╗ ██╗    ██████╗ 
        ██╔════╝██╔══██╗██╔════╝╚══██╔══╝    ██╔══██╗██╔════╝██╔══██╗██║     ██╔═══██╗╚██╗ ██╔╝    ██║   ██║███║   ██╔═████╗
        █████╗  ███████║███████╗   ██║       ██║  ██║█████╗  ██████╔╝██║     ██║   ██║ ╚████╔╝     ██║   ██║╚██║   ██║██╔██║
        ██╔══╝  ██╔══██║╚════██║   ██║       ██║  ██║██╔══╝  ██╔═══╝ ██║     ██║   ██║  ╚██╔╝      ╚██╗ ██╔╝ ██║   ████╔╝██║
        ██║     ██║  ██║███████║   ██║       ██████╔╝███████╗██║     ███████╗╚██████╔╝   ██║        ╚████╔╝  ██║██╗╚██████╔╝
        ╚═╝     ╚═╝  ╚═╝╚══════╝   ╚═╝       ╚═════╝ ╚══════╝╚═╝     ╚══════╝ ╚═════╝    ╚═╝         ╚═══╝   ╚═╝╚═╝ ╚═════╝ 
                                                                                                                            
        ══╝ ╚═════╝    ╚═╝                                                                                          
            ");
        }
    }
}