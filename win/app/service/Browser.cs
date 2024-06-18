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
    /// Class to threat all browser actions
    /// </summary>
    class Browser{
        /// <summary>
        /// Await 5s and redirect user to specific link
        /// </summary>
        /// <param name="url"></param>
        public static void redirect(string url){
            url = $"https://{url}";
            Logger.info($"Browser: Você será redirecionado para {url} em 5s.");
            System.Threading.Thread.Sleep(8000);
            System.Diagnostics.Process.Start("explorer.exe", url);
        }
    }
}