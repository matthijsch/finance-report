var gulp = require('gulp');
var chug = require('gulp-chug');
var argv = require('yargs').argv;
var taskLoader = require('gulp-simple-task-loader');
var chConfig = require('./frontend.json');
var syliusConfig = [
    '--rootPath',
    argv.rootPath || '../../../../../../../web/assets/',
    '--nodeModulesPath',
    argv.nodeModulesPath || '../../../../../../../node_modules/'
];

taskLoader({
    taskDirectory: 'node_modules/connectholland-gulp-tasks/tasks',
    config: chConfig
}, gulp);
