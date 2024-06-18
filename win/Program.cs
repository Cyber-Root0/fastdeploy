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
using PowerArgs;
using FastDeploy.app.template;
using FastDeploy.app.Strategy;
using FastDeploy.app;
namespace FastDeploy
{
    /// <summary>
    /// Main class
    /// </summary>
    class Program
    {
        /// <summary>
        /// Inicialização principal
        /// </summary>
        /// <param name="args"></param>
        static void Main(string[] args)
        {   
            splash();
            try
            {
                Args.InvokeAction<Commands>(args);
            }
            catch (ArgException ex)
            {
                Console.WriteLine(ex.Message);
            }
        }
        /// <summary>
        /// Splash banner
        /// </summary>
        private static void splash(){
            Splash s = new Splash();
            s.execute();
        }
    }

}
