pipeline {
    agent any

    environment {
        SRC_DIR = "${WORKSPACE}/src"
        DEPLOY_USER = "nanta"
        DEPLOY_HOST = "192.168.0.103"
        DEPLOY_PATH = "/home/nanta/prod.kelasdevops.xyz/prod"
    }

    stages {
        stage('Checkout') {
            steps {
                sh '''
                    echo "==> Checkout repository"
                    if [ ! -d ${SRC_DIR} ]; then
                        git clone -b main https://github.com/daranovia/tiketingaja.git ${SRC_DIR}
                    else
                        cd ${SRC_DIR}
                        git fetch origin
                        git reset --hard origin/main
                    fi
                    git config --global --add safe.directory ${WORKSPACE}
                    git config --global --add safe.directory ${SRC_DIR}
                '''
            }
        }

        stage('Build') {
            steps {
                script {
                    docker.image('composer:2').inside('--entrypoint=""') {
                        sh '''
                            cd ${SRC_DIR}
                            composer install --no-dev --optimize-autoloader
                            php artisan package:discover --ansi
                        '''
                    }
                }
            }
        }

        stage('Testing') {
            steps {
                echo "==> Placeholder Testing Stage"
            }
        }

        stage('Deploy to Debian') {
            steps {
                sshagent(['debian-ssh']) {
                    sh """
                        echo "==> Creating deploy directory on server"
                        ssh -o StrictHostKeyChecking=no nanta@192.168.0.103 "mkdir -p /home/nanta/prod.kelasdevops.xyz/prod"

                        echo "==> Copying files to server"
                        scp -o StrictHostKeyChecking=no -r ${SRC_DIR}/* nanta@192.168.0.103:/home/nanta/prod.kelasdevops.xyz/prod/

                        echo "==> Running composer & migrate on server"
                        ssh -o StrictHostKeyChecking=no nanta@192.168.0.103 '
                            cd /home/nanta/prod.kelasdevops.xyz/prod
                            composer install --no-dev --optimize-autoloader
                            php artisan migrate --force
                        '
                    """
                }
            }
        }
    }
}
