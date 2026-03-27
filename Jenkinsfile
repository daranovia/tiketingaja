pipeline {
    agent any

    environment {
        APP_DIR = "/var/jenkins_home/workspace/laravel-dev"
        SERVER_IP = "172.31.94.247"
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
                    // Fix Git safe directory
                    sh "git config --global --add safe.directory ${APP_DIR}"

                    // Composer install
                    docker.image('composer:2').inside('--entrypoint="" -u 1000:1000 -w ${APP_DIR}') {
                        sh '''
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
                    docker.image('ubuntu:latest').inside('--entrypoint="" -u 1000:1000 -w ${APP_DIR}') {
                        sh '''
                            echo "Ini adalah test pipeline"
                        '''
                    }
                }
            }
        }

       stage('Deploy to Production') {
            steps {
                script {
                    docker.image('agung3wi/alpine-rsync:1.1').inside('--entrypoint="" -u 1000:1000 -w ${APP_DIR}') {

                        sshagent(['ubuntu']) {

                            sh '''
                                echo "Setup SSH"

                                mkdir -p ${APP_DIR}/.ssh
                                chmod 700 ${APP_DIR}/.ssh

                                ssh-keyscan -H ${SERVER_IP} >> ${APP_DIR}/.ssh/known_hosts
                                chmod 644 ${APP_DIR}/.ssh/known_hosts
                            '''

                            sh '''
                                rsync -avz --delete \
                                -e "ssh -o StrictHostKeyChecking=no" \
                                --exclude='.git' \
                                --exclude='node_modules' \
                                --exclude='vendor' \
                                ./ ${SERVER_USER}@${SERVER_IP}:${SERVER_DIR}
                            '''
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
