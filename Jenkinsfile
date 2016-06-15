node {
    deleteDir()
    previousBuildVariables = currentBuild.getPreviousBuild() ?  currentBuild.getPreviousBuild().buildVariables : []
	if(previousBuildVariables['versionNumber'])
	    env.versionNumber = previousBuildVariables['versionNumber'].toInteger()
	else
	   env.versionNumber = 0;

    stage 'Checkout'	// Define a new Stage
    checkout scm        // Checkout the source code

    stage 'Build'			// Define a new stage
    sh 'composer install'	// Install the composer dependencies
    sh "find -L ./app -name '*.php' -print0 | xargs -0 -n 1 -P 4 php -l" //Perform syntactical code analysis on all files in the app folder

    stage 'Unit tests'			// Define a new stage
    sh 'vendor/bin/phpunit'		// Run the unit tests
}

try{
    input message: 'Deploy to Stage?', ok: 'yes'
} catch (all) {
    return
}

node {
    stage 'Deploy to Stage'
	env.versionNumber++

	withCredentials([[$class: 'AmazonWebServicesCredentialsBinding', accessKeyVariable: 'AWS_ACCESS_KEY_ID', credentialsId: 'aws', secretKeyVariable: 'AWS_SECRET_ACCESS_KEY']]) {
        sh "eb init"
        sh "eb deploy stage --label ${env.versionNumber.toString()}"
    }
}

try{
    deployments = input message: 'Select Environments', ok: 'Deploy', parameters: [[$class: 'BooleanParameterDefinition', defaultValue: true, description: '', name: 'prodA'], [$class: 'BooleanParameterDefinition', defaultValue: true, description: '', name: 'prodB']]
} catch (all) {
    return
}

node{
    stage 'First Deployment'
    deployFirst = []
    deploySecond = []
    for(item in deployments){
        if(item.value)
            deployFirst.push(item.key)
        else
            deploySecond.push(item.key)
    }
    deployments = null

    deploy(deployFirst, env.versionNumber)
}

if(!deploySecond){
    echo "Nothing more to deploy"
    return
}

try{
    input message: "Deploy to remaining?", ok: 'yes'
} catch (all) {
    echo "Rollback deployment"
    def previousVersion = env.versionNumber.toInteger() - 1
    deploy(deployFirst, previousVersion)
    return
}

node{
    stage 'Second Deployment'
    deploy(deploySecond, env.versionNumber)
    echo "Finished"
}

def deploy(environmentList, version) {
    withCredentials([[$class: 'AmazonWebServicesCredentialsBinding', accessKeyVariable: 'AWS_ACCESS_KEY_ID', credentialsId: 'aws', secretKeyVariable: 'AWS_SECRET_ACCESS_KEY']]) {
        for(environment in environmentList){
            sh "eb deploy $environment --version $version"
            echo "Deployed version $version to $environment"
        }
    }
}