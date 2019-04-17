<?php

$I = new ApiTester($scenario);

$data = [
    'keyword' => 'review'
];

$I->wantTo('get all reviews by keyword');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGET('reviews', $data);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile(codecept_data_dir('reviews.json'));
