### 🚀 Environment Setup

### 🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. [Install Docker Compose](https://docs.docker.com/compose/install/)
3. [Post installation steps for LINUX](https://docs.docker.com/engine/install/linux-postinstall/) (only LINUX)
4. [Install Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
5. [Generate ssh key in Github](https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent)
7. Clone these projects in app-ecosystem folder

### 🛠️ Environment configuration
1. Create a local environment file (`cp .env.dist .env.local`) if you want to modify any parameter

### 🔥 Application execution

1. Install all the dependencies and bring up the project with Docker executing: `make build
2. Then you'll have 1 app available (1 API):
API Backend: http://localhost:8040/health-check

### ✅ Tests execution

1. Install the dependencies if you haven't done it previously: `make deps
2. Execute PHPUnit tests: `make phpunit`