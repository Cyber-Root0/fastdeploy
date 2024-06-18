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
using DotNetEnv;
using PowerArgs;
namespace FastDeploy.app{
    /// <summary>
    /// Class provide default configs
    /// </summary>
    class Config{
        private static string remoteHost {get;set;} = "";
        private static string remoteUser{get;set;} = "";
        private static string remoteToken{get;set;} = "";
        private static string serviceUrl{get;set;} = "";
        private static string mainDomain{get;set;} = "";
        static Config(){
            DotNetEnv.Env.TraversePath().Load();
            initVars();
        }
        /// <summary>
        /// Initialize env global config
        /// </summary>
        private static void initVars(){
            remoteHost = getValue("REMOTE_HOST");
            remoteToken = getValue("REMOTE_TOKEN");
            serviceUrl = getValue("SERVICE_URL");
            mainDomain = getValue("REMOTE_DOMAIN");
            remoteUser = getValue("REMOTE_USER");
        }
        /// <summary>
        /// get specific value of env 
        /// </summary>
        /// <param name="key"></param>
        /// <returns></returns>
        private static string getValue(string key){
            return DotNetEnv.Env.GetString(key);
        }
        /// <summary>
        /// get remote user
        /// </summary>
        /// <returns></returns>
        public static string getRemoteUser(){
            return remoteUser;
        }
        /// <summary>
        /// get remote host config
        /// </summary>
        /// <returns></returns>
        public static string getRemoteHost(){
            return remoteHost;
        }
        /// <summary>
        /// get private ssh token
        /// </summary>
        /// <returns></returns>
        public static string getRemoteToken(){
            return remoteToken;
        }
        /// <summary>
        /// get service url
        /// </summary>
        /// <returns></returns>
        public static string getServiceUrl(){
            return serviceUrl;
        }
        public static string getDomain(){
            return mainDomain;
        }
    }
}