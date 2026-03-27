pipeline {
    agent any

    environment {
        COMPOSER_HOME = "${WORKSPACE}/.composer"
    }

    stages {
        stage('Checkout') {
            steps {
                sshagent(['jenkins-ssh-key']) {
                    sh '''
                        if [ ! -d src ]; then
                            git clone -b main git@github.com:daranovia/tiketingaja.git src
                        else
                            cd src
                            git fetch origin
                            git reset --hard origin/main
                        fi

                        git config --global --add safe.directory ${WORKSPACE}
                        git config --global --add safe.directory ${WORKSPACE}/src
                    '''
                }
            }
        }

        stage('Build') {
            steps {
                script {
                    docker.image('composer:2').inside('--entrypoint=""') {
                        sh '''
                            cd src
                            composer install --no-dev --optimize-autoloader
                            php artisan package:discover --ansi
                        '''
                    }
                }
            }
        }

        stage('Testing') {
            steps {
                echo 'Testing stage'
            }
        }

        stage('Deploy to Debian') {
            steps {
                sshagent(['jenkins-ssh-key']) {
                    sh """
                        ssh -o StrictHostKeyChecking=no nanta@192.168.0.103 "mkdir -p /home/nanta/prod.kelasdevops.xyz/prod"

                        scp -o StrictHostKeyChecking=no -r ${WORKSPACE}/src/* nanta@192.168.0.103:/home/nanta/prod.kelasdevops.xyz/prod/

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
