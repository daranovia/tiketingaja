pipeline {
    agent any

    environment {
        APP_DIR = "/var/jenkins_home/workspace/laravel-dev"
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

                    // Jalankan composer di container dengan entrypoint kosong
                    docker.image('composer:2').inside('--entrypoint="" -u 1000:1000 -w ${APP_DIR}') {
                        sh 'rm -f composer.lock'
                        sh 'composer install'
                        sh 'composer dump-autoload -o'
                    }
                }
            }
        }

        stage('Testing') {
            steps {
                script {
                    // Bisa pakai Ubuntu container untuk testing
                    docker.image('ubuntu:latest').inside('--entrypoint="" -u 1000:1000 -w ${APP_DIR}') {
                        sh 'echo "Ini adalah test"'
                        // Tambahkan unit test Laravel jika perlu
                        // sh 'php artisan test'
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
                                mkdir -p .ssh
                                chmod 700 .ssh
                                ssh-keyscan -H 172.31.94.247 >> .ssh/known_hosts
                            '''

                            sh '''
                                rsync -avz --delete ./ ubuntu@172.31.94.247:/var/www/laravel-app
                            '''
                        }
                    }
                }
            }
        }

    }

    post {
        failure {
            echo "Pipeline gagal, cek log di stage yang error."
        }
        success {
            echo "Pipeline berhasil dijalankan."
        }
    }
}
