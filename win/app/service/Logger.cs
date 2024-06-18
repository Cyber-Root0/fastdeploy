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
namespace FastDeploy.app.service{
    /// <summary>
    /// Logger class
    /// </summary>
    class Logger{
        /// <summary>
        /// Print the message on CLI with a current formateded datetime
        /// </summary>
        /// <param name="msg"></param>
        public static void info(string msg){
            var strHour = getHour();
            Console.WriteLine($"{strHour} - {msg}");
        }
        /// <summary>
        /// Get current hour
        /// </summary>
        /// <returns></returns>
        private static string getHour(){
            DateTime hour = DateTime.Now;
            string strHour = hour.ToString("[dd/MM/yyyy HH:mm]");
            return strHour;
        }
    }
}