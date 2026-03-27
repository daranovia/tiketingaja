pipeline {
    agent any

    environment {
        APP_DIR = "/var/jenkins_home/workspace/laravel-dev"
        SERVER_IP = "172.31.80.1"
        SERVER_USER = "ubuntu"
        SERVER_DIR = "/var/www/laravel-app"
    }

    stages {

        stage('Checkout') {
            steps {
                git url: 'https://github.com/daranovia/tiketingaja.git', branch: 'main'
            }
        }

        stage('Build') {
            steps {
                script {
                    sh '''
                        rm -f /var/jenkins_home/.gitconfig.lock
                        git config --global --add safe.directory ${APP_DIR}
                    '''

                    docker.image('composer:2').inside('--network host') {
                        sh '''
                            echo "Installing Composer Dependencies..."

                            rm -f composer.lock
                            composer install --no-interaction --prefer-dist
                            composer dump-autoload -o
                        '''
                    }
                }
            }
        }
        stage('Testing') {
            steps {
                script {
                    docker.image('ubuntu:latest').inside('-u 1000:1000 -w ${APP_DIR}') {
                        sh '''
                            echo "Testing pipeline berjalan..."
                        '''
                    }
                }
            }
        }

        stage('Deploy to Production') {
            steps {
                script {
                    docker.image('agung3wi/alpine-rsync:1.1').inside('-u 0:0 -w ${APP_DIR}') {

                        sshagent(['ubuntu']) {

                            sh """
                                echo "Deploying ke server..."

                                rsync -avz --delete \
                                -e "ssh -o StrictHostKeyChecking=no" \
                                --exclude='.git' \
                                --exclude='node_modules' \
                                --exclude='vendor' \
                                ./ ${SERVER_USER}@${SERVER_IP}:${SERVER_DIR}
                            """
                        }
                    }
                }
            }
        }

    }

    post {
        success {
            echo "Pipeline berhasil dijalankan 🚀"
        }

        failure {
            echo "Pipeline gagal ❌ cek log"
        }
    }
}
