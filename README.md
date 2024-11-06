
# Projeto Integrador 2

Este projeto é uma aplicação Laravel que faz o gerenciamento de pacientes e controle de orçamentos, desenvolvido para a clínica Eloy Verão Odontologia. Esse sistema tem como objetivo ajudar a clínica a acompanhar os pacientes que receberam orçamentos, mas ainda não fecharam o tratamento. Ele permite que usuários da clínica se cadastrem, façam login, cadastrem pacientes, gerenciem orçamentos e busquem endereços através da Geocoding API do Google, facilitando o controle e acompanhamento das etapas por meio dos status dos orçamentos. Isso contribui para a organização interna da clínica e o fortalecimento do relacionamento com os pacientes.

## Funcionalidades

- Cadastro de usuários: Permite que novos usuários se registrem na plataforma.
- Login e autenticação: Sistema de login seguro para acesso ao sistema.
- Cadastro de pacientes:  Facilita o cadastro de informações dos pacientes.
- Cadastro de orçamentos: Permite que orçamentos sejam criados e associados aos pacientes.
- Gestão dos orçamentos e pacientes: Interface para visualizar, editar e excluir orçamentos e dados dos pacientes.
- Integração com a Geocoding API do Google: A API é usada para buscar endereços a partir do CEP de um endereço.

## Tecnologias utilizadas

**Front-end:**
- ***Tailwind CSS:*** Framework de CSS para design responsivo e customizado.
- ***Axios:*** Biblioteca para realizar requisições AJAX no frontend.

**Back-end:** 
- ***Laravel:*** Framework PHP para o desenvolvimento da aplicação.
- ***MySQL:*** Banco de dados utilizado para armazenar informações.
- ***XAMPP:*** Usado como servidor local para rodar a aplicação Laravel.
- ***Geocoding API:*** API do Google para buscar endereços a partir de coordenadas geográficas e vice-versa.

**Ferramentas de Desenvolvimento:**
- ***Git:*** Sistema de controle de versão utilizado para gerenciar o código fonte.
- ***Composer:*** Gerenciador de dependências PHP.
- ***NPM:*** Gerenciador de pacotes para JavaScript.
- ***Visual Studio Code:*** IDE usada para o desenvolvimento da aplicação.
## Passo a Passo para Subir o Software

### Pré-requisitos
*Certifique-se de que você tenha as seguintes ferramentas instaladas:*

 - **Git:** [*Instalar Git*](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
 - **Composer:** [*Instalar Composer*](https://getcomposer.org/)
 - **XAMPP:** [*Instalar XAMPP*](https://www.apachefriends.org/pt_br/index.html)
 - **Node.js:**  [*Instalar Node.js*](https://nodejs.org/pt)
 - **Visual Studio Code:**  [*Instalar Visual Studio Code*](https://code.visualstudio.com/)

## Passo a Passo para Subir o Software

### Instruções para instalar

**1. Clone o repositório do projeto:**

Abra o terminal e execute o comando abaixo para clonar o repositório do projeto:

```bash
git clone https://github.com/serginhos3/Oficial-Projeto-Integrador-2-.git
```
    
*Depois de clonar, entre no diretório do projeto:*
```bash
cd Oficial-Projeto-Integrador-2-
```

**2. Abra o terminal no Visual Studio Code:**

- Abra o Visual Studio Code.
- No menu superior, clique em **File > Open Folder** (ou **Arquivo > Abrir Pasta**).
- Selecione a pasta onde você clonou o repositório e clique em **Abrir**.

*Para abrir o terminal integrado dentro do VSCode, pressione:*

- **Ctrl + `** (a tecla abaixo do Esc) no Windows/Linux.
- **Cmd + `** no macOS.

**3. Instale as dependências com o Composer:**

O Laravel usa o Composer para gerenciar suas dependências. Para instalar as dependências, execute o seguinte comando:

```bash
composer install
```

*Isso vai baixar todas as dependências listadas no arquivo `composer.json` e configurá-las.*

**4. Instale as dependências do JavaScript com o NPM:**

O Laravel utiliza o NPM para gerenciar pacotes JavaScript. Execute o comando abaixo para instalar as dependências JavaScript:

```bash
npm install
```
*Isso vai baixar todas as dependências do frontend necessárias (como, Tailwind CSS, Axios, etc.).*

**5. Configure o arquivo de ambiente:**

O Laravel usa o arquivo `.env` para armazenar configurações sensíveis, como dados de acesso ao banco de dados. Renomeie o arquivo `.env.example` para `.env` com o seguinte comando:

```bash
cp .env.example .env
```
*Abra o arquivo `.env` e configure as informações do seu banco de dados MySQL e da Geocoding API do Google. Por exemplo:*

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

GOOGLE_API_KEY=SuaChaveDaAPI
```
**6. Gere a chave da aplicação:**

Laravel usa uma chave de segurança para criptografar sessões e outros dados. Gere a chave da aplicação executando:

```bash
php artisan key:generate
```
*Isso irá gerar a chave no arquivo `.env.`*

**7. Inicie o XAMPP:**

Caso ainda não tenha feito, abra o **XAMPP Control Panel**, inicie o **Apache** (para rodar o servidor web) e o **MySQL** (para rodar o banco de dados). Isso é necessário para que o Laravel possa funcionar corretamente.


**8. Configure o Banco de Dados:**

Certifique-se de que o MySQL esteja rodando no XAMPP e crie um banco de dados para a aplicação. Depois, execute as migrações para criar as tabelas no banco de dados:

```bash
php artisan migrate
```


**9. Inicie o servidor local:**

Após configurar o ambiente, você pode iniciar o servidor Laravel utilizando o comando abaixo:

```bash
php artisan serve
```
*Isso fará o servidor local rodar na URL* `http://localhost:8000.`


## Uso/Exemplos

- Acesse http://localhost:8000 no seu navegador para visualizar a aplicação.

- Para o primeiro acesso: Você pode se cadastrar clicando no botão **`'Crie sua conta'`** na página inicial. Após o cadastro, faça login para acessar a página inicial.

## Rodando os testes

A aplicação já possui testes automatizados para garantir que tudo esteja funcionando corretamente. Para rodá-los, use o seguinte comando:

```bash
  php artisan test
```
