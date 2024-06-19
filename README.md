### 🚀 Facilitando o Deploy de Aplicações com o FastDeploy 🚀

Você já enfrentou desafios ao disponibilizar seus projetos locais publicamente? O **FastDeploy** é a solução que você precisa!

Essa poderosa ferramenta automatiza o deploy de suas aplicações locais diretamente no servidor, utilizando **SSH Port Forwarding** juntamente com o **reverse proxy do Nginx**, tudo isso integrado com a **Cloudflare**.

🔹 **Automação e Facilidade**: Com o FastDeploy, você não precisa se preocupar com processos manuais e complexos de deploy. Ele cuida de tudo para você!

🔹 **Subdomínio Automático no Windows**: Ao ser executado no Windows, o FastDeploy cria automaticamente um subdomínio, redirecionando para a porta local da sua aplicação. Isso significa que sua aplicação estará disponível através de um link público em questão de segundos.

🔹 **Segurança e Performance**: Integrando com a Cloudflare, o FastDeploy garante que sua aplicação não apenas esteja disponível publicamente, mas também tenha um certificado SSL para o HTTPS para Segurança e Performance.

O FastDeploy é a ferramenta ideal para desenvolvedores que desejam compartilhar seus projetos locais de maneira simples e eficiente. Não perca mais tempo com configurações complicadas.

Experimente o FastDeploy e veja como ele pode transformar a maneira como você faz deploy das suas aplicações!
## Instalação no Windows

Faça o Download do repositório

```bash
  git clone https://github.com/Cyber-Root0/fastdeploy
```
Abra a pasta "releases" de acordo com a compatibilidade com o seu Windows.

```bash
  cd fastdeploy && cd releases/Windows/v1/net6.0
```

Inicie a ferramenta com o comando:

```bash
  FastDeploy deploy
```
#### Configurando a ferramenta.

🔹 **localPort**: Porta onde o seu projeto está rodando na máquina atual.

🔹 **domain**: Nome do subdominio alocado para o projeto atual.

![CLI TOOL](https://raw.githubusercontent.com/Cyber-Root0/fastdeploy/master/doc/images/cli-tool.png)


#### Veja o projeto Local disponivel com link público em segundos:
![Logo](https://raw.githubusercontent.com/Cyber-Root0/fastdeploy/master/doc/images/localproject.png)


USAR VPS DEDICADA:
--------------

*   PHP instalado
*   Nginx configurado
*   Conta e token de API do Cloudflare

Instalação no Linux
-------------------

1.  **Instale o PHP** se ainda não estiver instalado.
    
2.  **Configure o Nginx**:
    
    *   Crie uma aplicação no Nginx em `/var/www/fastdeploy`.
    *   Clone o repositório do GitHub para o diretório criado:
        
        `git clone <URL_DO_REPOSITORIO> /var/www/fastdeploy`
        
3.  **Configuração do arquivo `config.php`**:
    
    *   Navegue até o diretório `/var/www/fastdeploy`.
    *   Edite o arquivo `var/config.php` com os seguintes parâmetros:
        
        `define('CLOUDFLARE_TOKEN', ''); // Token da API do Cloudflare `
        
        `define('CLOUDFLARE_ZONE', ''); // Zona do Cloudflare`

        `define('SERVER_IP', ''); // IP do servidor`
        

Executando o FastDeploy no Windows
----------------------------------

1.  **Compile a aplicação**:
    
    *   Navegue até o diretório `/win`.
    *   Compile a aplicação.
2.  **Configure o arquivo `.env`**:
    
    *   Antes de compilar, edite o arquivo `.env` com as seguintes informações:
        
* REMOTE_HOST=""       # IP do servidor** 
* REMOTE_USER=""       # Usuário SSH** 
* REMOTE_TOKEN=""      # Senha SSH 
* REMOTE_DOMAIN=""     # Domínio principal 
* SERVICE_URL=""       # Domínio da aplicação no Nginx
        
3.  **Execute a aplicação**:
    
    *   Após a configuração, execute a aplicação compilada para iniciar o deploy.

Funcionamento
-------------

O FastDeploy automatiza o processo de deploy utilizando as seguintes tecnologias:

*   **SSH Port Forwarding**: Para comunicação segura com o servidor remoto.
*   **Nginx Reverse Proxy**: Para roteamento de requisições.
*   **Cloudflare**: Para gerenciamento de DNS e proteção DDoS.

### Criação de Subdomínio

Ao ser executado no Windows, FastDeploy cria automaticamente um subdomínio que redireciona para a porta local da aplicação, tornando a aplicação acessível através de um link público.

Com essas integrações, o FastDeploy facilita o deploy contínuo e seguro de suas aplicações, garantindo que todas as alterações locais sejam refletidas automaticamente no servidor.

Contribuições
-------------

Contribuições são bem-vindas! Para reportar bugs ou sugerir melhorias, abra uma issue no repositório GitHub.

Licença
-------

Este projeto está licenciado sob a licença MIT. Consulte o arquivo LICENSE para obter mais informações.

* * *

Para mais detalhes sobre o uso e contribuições, consulte a documentação completa no repositório GitHub.
## 🚀 About Me
I'm Bruno Alves from Brazil

- 🔭 I’m working as PHP Developer
- 📚 I'm currently learning 3DS Secure Payments, Banks Integrations
- ⚡ In my free time I play games and watch movies


## 🔗 Links
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/bruno-fullsteck/)
