
# Portfolio Builder

A microservices-based portfolio builder application built with PHP, designed for creating and managing portfolio websites.

## 📋 Overview

Portfolio Builder is an SDE mini project that provides a complete solution for building and managing portfolio websites. The application follows a microservices architecture and can be deployed on Kubernetes.

## 🏗️ Architecture

The project is structured in a microservices architecture with three main services:

### Services

1. **Admin Service** (`/microservices/admin-service`)
   - Administration panel for portfolio management
   - User authentication and authorization using JWT

2. **Super Admin Service** (`/microservices/superadmin-service`)
   - High-level administrative controls
   - System-wide management capabilities

3. **Website Service** (`/microservices/website-service`)
   - Public-facing portfolio website
   - Markdown rendering support
   - Caching layer using Symfony Cache

### Monolith Version
The project also includes a monolithic version in the `/monolith` directory for simpler deployment scenarios.

## 🛠️ Technology Stack

- **Language:** PHP 8.3
- **Framework:** Scrawler Framework
- **Template Engine:** Blade
- **Database:** MySQL (PDO)
- **Authentication:** JWT (ReallySimpleJWT)
- **Containerization:** Docker
- **Orchestration:** Kubernetes
- **Web Server:** Apache

### Key Dependencies

- `scrawler/app` - Application framework
- `scrawler/database` - Database abstraction
- `scrawler/blade` - Blade templating engine
- `scrawler/storage` - Storage management
- `filp/whoops` - Error handling
- `vlucas/phpdotenv` - Environment configuration
- `rbdwllr/reallysimplejwt` - JWT authentication
- `erusev/parsedown` - Markdown parser (website service)
- `symfony/cache` - Caching layer (website service)

## 🚀 Getting Started

### Prerequisites

- Docker and Docker Compose
- Kubernetes cluster (for K8s deployment)
- PHP 8.3+ (for local development)
- Composer

### Local Development

1. Clone the repository:
```bash
git clone https://github.com/ipranjal/portfolio-builder.git
cd portfolio-builder
```

2. Navigate to a service directory:
```bash
cd microservices/admin-service
# or
cd microservices/superadmin-service
# or
cd microservices/website-service
```

3. Install dependencies:
```bash
composer install
```

4. Configure environment variables:
```bash
cp .env.example .env
# Edit .env with your configuration
```

### Docker Deployment

Each microservice includes a Dockerfile for containerized deployment:

```bash
# Build a service
docker build -t portfolio-admin ./microservices/admin-service

# Run the container
docker run -p 8080:80 portfolio-admin
```

### Kubernetes Deployment

The `/k8s` directory contains Kubernetes manifests for production deployment:

- `deployment.yaml` - Service deployments
- `service.yaml` - Service definitions
- `ingress.yaml` - Ingress routing configuration
- `autoscale.yaml` - Horizontal Pod Autoscaler configuration

Deploy to Kubernetes: 

```bash
kubectl apply -f k8s/
```

## 📁 Project Structure

```
portfolio-builder/
├── microservices/
│   ├── admin-service/        # Admin management service
│   ├── superadmin-service/   # Super admin service
│   └── website-service/      # Public website service
├── monolith/                 # Monolithic version
├── k8s/                      # Kubernetes manifests
│   ├── deployment.yaml
│   ├── service.yaml
│   ├── ingress.yaml
│   └── autoscale.yaml
└── . github/                  # GitHub workflows and configs
```

## 🔧 Configuration

Each service uses environment variables for configuration.  Create a `.env` file in each service directory based on the example:

```env
DB_HOST=localhost
DB_NAME=portfolio
DB_USER=root
DB_PASS=secret
JWT_SECRET=your-secret-key
```

## 📝 License

This project is licensed under the MIT License.

## 👤 Author

**Pranjal**
- GitHub: [@ipranjal](https://github.com/ipranjal)
- Email: hello@ipranjal.com
