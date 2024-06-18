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
using System.Text.RegularExpressions;
using FastDeploy.app;
namespace FastDeploy.app.Params
{
    /// <summary>
    /// Deploy command class
    /// </summary>
    class Deploy
    {
        private string _domain = "";
        private static readonly Regex DomainRegex = new Regex(@"^(?!-)[a-zA-Z-]+(?<!-)$");
        [ArgRequired(PromptIfMissing = true), ArgShortcut("-l"), ArgDescription("Host local, por exemplo: (127.0.0.1) ou (localhost)"), ArgDefaultValue("127.0.0.1")]
        public string localhost { get; set; } = "";
        [ArgRequired(PromptIfMissing = true), ArgShortcut("-p"), ArgDescription("Porta na qual o seu projeto está rodando localmente"), ArgRange(1, 65535)]
        public int localPort { get; set; }
        [ArgRequired(PromptIfMissing = true), ArgShortcut("-s"), ArgDescription("Insira o sub-dominio, ex: myapp")]
        public string domain

        {
            get
            {
                return _domain;
            }
            set
            {
                if (string.IsNullOrEmpty(value))
                {
                    throw new Exception("O domínio não pode ser vazio.");
                }
                if (!DomainRegex.IsMatch(value))
                {
                    throw new Exception("O subdomínio precisa ser válido, por exemplo: 'meuapp' ou 'meu-app'.");
                }
                _domain = value +"."+ Config.getDomain();
            }
        }
    }

}