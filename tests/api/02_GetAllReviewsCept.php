<?php

$I = new ApiTester($scenario);

$I->wantTo('get all reviews');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGET('reviews');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->canSeeResponseIsValidOnSchemaFile(codecept_data_dir('reviews.json'));
