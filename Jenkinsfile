pipeline {
    agent any

    environment {
        APP_DIR = "/var/jenkins_home/workspace/laravel-dev"
        SERVER_IP = "192.168.0.103"
        SERVER_USER = "nanta"
        SERVER_DIR = "/var/www/laravel-app"
    }

    stages {

        stage('Checkout') {
            steps {
             
                deleteDir()
                git url: 'https://github.com/daranovia/tiketingaja.git', branch: 'main'
            }
        }

        stage('Build') {
            steps {
                script {
                    echo "Installing Composer Dependencies..."


                    sh '''
                        docker run --rm -v $PWD:/app -w /app composer:2 bash -c "
                            rm -f composer.lock
                            composer install --no-interaction --prefer-dist
                            composer dump-autoload -o
                        "
                    '''
                }
            }
        }

        stage('Testing') {
            steps {
                script {
                    echo "Testing pipeline berjalan..."

                    sh '''
                        if [ -f ./vendor/bin/phpunit ]; then
                            ./vendor/bin/phpunit --colors=always
                        else
                            echo "PHPUnit tidak ditemukan, skip testing"
                        fi
                    '''
                }
            }
        }

        stage('Deploy to Production') {
            steps {
                script {
                    echo "Deploying ke server..."


                    sshagent(['ubuntu']) {
                        sh """
                            rsync -avz --delete \
                            -e "ssh -o StrictHostKeyChecking=no" \
                            --exclude='.git' --exclude='node_modules' --exclude='vendor' \
                            ./ ${SERVER_USER}@${SERVER_IP}:${SERVER_DIR}
                        """
                    }
                }
            }
        }

    }

    post {
        success {
            echo "Pipeline berhasil dijalankan"
        }
        failure {
            echo "Pipeline gagal cek log"
        }
    }
}
