#!/bin/bash
#Cria um usuario SSH com privilégio de executar fastdeploy como root sem senha
sudo adduser -m fastdeploy -s /bin/rbash
echo "fastdeploy ALL=(ALL) NOPASSWD: /var/www/fastdeploy/bin/fastdeploy" >> /etc/sudoers.d/fastdeploy
