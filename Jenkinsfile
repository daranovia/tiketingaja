pipeline {
    agent any

    environment {
        APP_DIR = "${WORKSPACE}"
    }

    stages {
        stage('Checkout') {
            steps {
                // clone repo
                git branch: 'main', url: 'https://github.com/daranovia/tiketingaja.git'
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-interaction --prefer-dist'
            }
        }

        stage('Run Migrations') {
            steps {
                sh 'php artisan migrate --force'
            }
        }

        stage('Test') {
            steps {
                sh 'php artisan test'
            }
        }
    }
}
