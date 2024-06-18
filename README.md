<div class="flex w-full flex-col gap-1 juice:empty:hidden juice:first:pt-[3px]"><div class="markdown prose w-full break-words dark:prose-invert light"><h1>FastDeploy</h1><p>FastDeploy é uma ferramenta que automatiza o deploy de aplicações locais no servidor, utilizando SSH Port Forwarding juntamente com o reverse proxy do Nginx, integrado com a Cloudflare. Além disso, ao ser executado no Windows, FastDeploy cria um subdomínio automaticamente, redirecionando para a porta local da aplicação, fazendo com que a aplicação fique disponível através de um link público.</p><h2>Pré-requisitos</h2><ul><li>PHP instalado</li><li>Nginx configurado</li><li>Conta e token de API do Cloudflare</li></ul><h2>Instalação no Linux</h2><ol><li><p><strong>Instale o PHP</strong> se ainda não estiver instalado.</p></li><li><p><strong>Configure o Nginx</strong>:</p><ul><li>Crie uma aplicação no Nginx em <code>/var/www/deploy</code>.</li><li>Clone o repositório do GitHub para o diretório criado:<pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span>sh</span><div class="flex items-center"><span class="" data-state="closed"><button class="flex gap-1 items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="icon-sm"><path fill="currentColor" fill-rule="evenodd" d="M7 5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-2v2a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h2zm2 2h5a3 3 0 0 1 3 3v5h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1zM5 9a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h9a1 1 0 0 0 1-1v-9a1 1 0 0 0-1-1z" clip-rule="evenodd"></path></svg>Copy code</button></span></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-sh">git <span class="hljs-built_in">clone</span> &lt;URL_DO_REPOSITORIO&gt; /var/www/deploy
</code></div></div></pre></li></ul></li><li><p><strong>Configuração do arquivo <code>config.php</code></strong>:</p><ul><li>Navegue até o diretório <code>/var/www/deploy</code>.</li><li>Edite o arquivo <code>config.php</code> com os seguintes parâmetros:<pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span>php</span><div class="flex items-center"><span class="" data-state="closed"><button class="flex gap-1 items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="icon-sm"><path fill="currentColor" fill-rule="evenodd" d="M7 5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-2v2a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h2zm2 2h5a3 3 0 0 1 3 3v5h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1zM5 9a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h9a1 1 0 0 0 1-1v-9a1 1 0 0 0-1-1z" clip-rule="evenodd"></path></svg>Copy code</button></span></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-php"><span class="hljs-title function_ invoke__">define</span>(<span class="hljs-string">'CLOUDFLARE_TOKEN'</span>, <span class="hljs-string">''</span>); <span class="hljs-comment">// Token da API do Cloudflare</span>
<span class="hljs-title function_ invoke__">define</span>(<span class="hljs-string">'CLOUDFLARE_ZONE'</span>, <span class="hljs-string">''</span>); <span class="hljs-comment">// Zona do Cloudflare</span>
<span class="hljs-title function_ invoke__">define</span>(<span class="hljs-string">'SERVER_IP'</span>, <span class="hljs-string">''</span>); <span class="hljs-comment">// IP do servidor</span>
</code></div></div></pre></li></ul></li></ol><h2>Executando o FastDeploy no Windows</h2><ol><li><p><strong>Compile a aplicação</strong>:</p><ul><li>Navegue até o diretório <code>/win</code>.</li><li>Compile a aplicação.</li></ul></li><li><p><strong>Configure o arquivo <code>.env</code></strong>:</p><ul><li>Antes de compilar, edite o arquivo <code>.env</code> com as seguintes informações:<pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span>makefile</span><div class="flex items-center"><span class="" data-state="closed"><button class="flex gap-1 items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="icon-sm"><path fill="currentColor" fill-rule="evenodd" d="M7 5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-2v2a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h2zm2 2h5a3 3 0 0 1 3 3v5h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1zM5 9a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h9a1 1 0 0 0 1-1v-9a1 1 0 0 0-1-1z" clip-rule="evenodd"></path></svg>Copy code</button></span></div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-makefile">REMOTE_HOST=<span class="hljs-string">""</span>       <span class="hljs-comment"># IP do servidor</span>
REMOTE_USER=<span class="hljs-string">""</span>       <span class="hljs-comment"># Usuário SSH</span>
REMOTE_TOKEN=<span class="hljs-string">""</span>      <span class="hljs-comment"># Senha SSH</span>
REMOTE_DOMAIN=<span class="hljs-string">""</span>     <span class="hljs-comment"># Domínio principal</span>
SERVICE_URL=<span class="hljs-string">""</span>       <span class="hljs-comment"># Domínio da aplicação no Nginx</span>
</code></div></div></pre></li></ul></li><li><p><strong>Execute a aplicação</strong>:</p><ul><li>Após a configuração, execute a aplicação compilada para iniciar o deploy.</li></ul></li></ol><h2>Funcionamento</h2><p>O FastDeploy automatiza o processo de deploy utilizando as seguintes tecnologias:</p><ul><li><strong>SSH Port Forwarding</strong>: Para comunicação segura com o servidor remoto.</li><li><strong>Nginx Reverse Proxy</strong>: Para roteamento de requisições.</li><li><strong>Cloudflare</strong>: Para gerenciamento de DNS e proteção DDoS.</li></ul><h3>Criação de Subdomínio</h3><p>Ao ser executado no Windows, FastDeploy cria automaticamente um subdomínio que redireciona para a porta local da aplicação, tornando a aplicação acessível através de um link público.</p><p>Com essas integrações, o FastDeploy facilita o deploy contínuo e seguro de suas aplicações, garantindo que todas as alterações locais sejam refletidas automaticamente no servidor.</p><h2>Contribuições</h2><p>Contribuições são bem-vindas! Para reportar bugs ou sugerir melhorias, abra uma issue no repositório GitHub.</p><h2>Licença</h2><p>Este projeto está licenciado sob a licença MIT. Consulte o arquivo LICENSE para obter mais informações.</p><hr><p>Para mais detalhes sobre o uso e contribuições, consulte a documentação completa no repositório GitHub.</p></div></div>
