node {

    // Checkout kode dari repository
    checkout scm

    stage('Build') {
        docker.image('composer:2').inside('-u root') {
            sh 'rm -f composer.lock'
            sh 'composer install'
        }
    }

    stage('Testing') {
        docker.image('ubuntu').inside('-u root') {
            sh 'echo "Ini adalah test"'
        }
    }

    stage('Deploy to Production') {
        docker.image('agung3wi/alpine-rsync:1.1').inside('-u root') {
            sshagent (credentials: ['ssh-prod']) {
                // Pastikan known_hosts terupdate
                sh 'mkdir -p ~/.ssh'
                sh 'ssh-keyscan -H "$PROD_HOST" >> ~/.ssh/known_hosts'

                // Jalankan rsync untuk deploy Laravel
                sh """
                rsync -rav --delete ./laravel/ ubuntu@$PROD_HOST:/home/ubuntu/prod.kelasdevops.xyz/ \
                --exclude=.env --exclude=storage --exclude=.git
                """
            }
        }
    }
}
