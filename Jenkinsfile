pipeline {
    agent any

    environment {
        APP_DIR = "/var/jenkins_home/workspace/laravel-dev"
        SERVER_IP = "192.168.0.103"
        SERVER_USER = "nanta"
        SERVER_DIR = "/var/www/laravel-app"
    }

    stages {

        stage('Clean Workspace') {
            steps {
                echo "Membersihkan workspace lama..."
                deleteDir() // hapus semua file lama di workspace
            }
        }

        stage('Checkout') {
            steps {
                echo "Checkout repository Laravel..."
                checkout([$class: 'GitSCM',
                          branches: [[name: '*/main']],
                          doGenerateSubmoduleConfigurations: false,
                          extensions: [[$class: 'WipeWorkspace']],
                          userRemoteConfigs: [[url: 'https://github.com/daranovia/tiketingaja.git']]])
            }
        }

        stage('Build') {
            steps {
                script {
                    echo "Build Laravel pakai Docker + Composer..."

                    docker.image('composer:2').inside('--network host') {
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
                    docker.image('ubuntu:latest').inside("-u 1000:1000 -w ${APP_DIR}") {
                        sh '''
                            echo "Testing pipeline berjalan..."
                            php artisan --version
                        '''
                    }
                }
            }
        }

        stage('Deploy to Production') {
            steps {
                script {
                    docker.image('agung3wi/alpine-rsync:1.1').inside("-u 0:0 -w ${APP_DIR}") {
                        sshagent(['ubuntu']) { // pastikan credential ssh sudah ada di Jenkins
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
