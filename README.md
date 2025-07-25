# BankManager - Sistema de Gestão Acadêmica

Este é um sistema de gestão acadêmica simples desenvolvido em PHP, seguindo o padrão arquitetural MVC (Model-View-Controller) e sem a utilização de frameworks, conforme os requisitos de um teste técnico.

## 🚀 Funcionalidades

O sistema permite a gestão das seguintes entidades:

* **Áreas de Cursos**: CRUD (Criação, Leitura, Atualização, Exclusão) de áreas como "Biologia", "Química", "Física".
* **Cursos**: CRUD de cursos, com título, descrição e associação a uma área existente.
* **Alunos**: CRUD de alunos, com nome, e-mail e data de nascimento. Inclui funcionalidade de busca por nome e e-mail.
* **Matrículas**: CRUD de matrículas, associando um aluno a um curso.
* **Autenticação**: Tela de login para acesso ao painel administrativo.

## 🛠️ Tecnologias Utilizadas

* **Backend**: PHP 8.4.10
* **Banco de Dados**: PhpMyAdmin / MySQL / MariaDB
* **Servidor Web**: Apache / Nginx
* **Gerenciamento de Dependências**: Composer
* **Controle de Versão**: Git

## 📋 Pré-requisitos

Para rodar este projeto localmente, você precisará ter instalado em sua máquina:

* **PHP**: Versão 8.x ou superior.
* **Composer**: Para instalar as dependências do PHP.
* **Servidor Web**: Apache (com `mod_rewrite` habilitado) ou Nginx.
* **PhpMyAdmin / MySQL / MariaDB**: Um servidor de banco de dados.

## ⚙️ Configuração do Ambiente

Siga os passos abaixo para configurar e executar a aplicação:

1.  **Clone o Repositório:**
    ```bash
    git clone https://github.com/JPGodinho/bankmanager.git
    cd bankmanager
    ```

2.  **Configurar o Banco de Dados:**
    * Crie um banco de dados MySQL/MariaDB chamado `bankmanager`.
    * Atualize as credenciais de acesso no arquivo `config/database.php` se forem diferentes das padrão (`root` sem senha):
        ```php
        class Database {
            private static $host = 'localhost';
            private static $dbName = 'bankmanager';
            private static $username = 'root';
            private static $password = '';
        }
        ```
    * **Executar Migrations (Criação das Tabelas):**
        * **(PENDENTE - Próximo passo do Plus++):** Você precisará rodar o script de migrations para criar as tabelas `areas`, `alunos`, `cursos` e `matriculas`. Por enquanto, você pode criar as tabelas manualmente ou usar um cliente SQL (como PhpMyAdmin, DBeaver, MySQL Workbench) executando as queries de `CREATE TABLE` para:
            * `areas` (id, titulo, descricao)
            * `alunos` (id, nome, email, data_nascimento)
            * `cursos` (id, titulo, descricao, area_id)
            * `matriculas` (id, aluno_id, curso_id, data_matricula)
            * _Não esqueça das chaves estrangeiras (`FOREIGN KEY`) e da coluna `data_matricula` na tabela `matriculas` com `DEFAULT CURRENT_TIMESTAMP`._

3.  **Instalar Dependências PHP:**
    ```bash
    composer install
    ```

4.  **Configurar o Servidor Web:**
    * Certifique-se de que a pasta `public/` do projeto seja o `DocumentRoot` ou o ponto de entrada da sua aplicação no servidor web.
    * Verifique se o módulo `mod_rewrite` está habilitado (para Apache) para que as URLs amigáveis funcionem corretamente (geralmente via `.htaccess`).
    * **Exemplo para Apache (no seu `httpd.conf` ou um arquivo de configuração de VirtualHost):**
        ```apache
        <VirtualHost *:80>
            DocumentRoot "/caminho/completo/para/seu/projeto/bankmanager/public"
            <Directory "/caminho/completo/para/seu/projeto/bankmanager/public">
                AllowOverride All
                Require all granted
            </Directory>
            # ...
        </VirtualHost>
        ```
        *Substitua `/caminho/completo/para/seu/projeto/bankmanager/public` pelo caminho real onde você clonou o projeto.*

5.  **Acessar a Aplicação:**
    * Após configurar o servidor web, você poderá acessar a aplicação através do seu navegador, geralmente em: `http://localhost/bankmanager/public` ou `http://localhost`.

## 🔒 Acesso ao Sistema

* **URL de Login**: `http://localhost/bankmanager/public/auth/login`
* **Credenciais Padrão (Admin)**:
    * **Email**: `admin@admin.com`
    * **Senha**: `123456`

---