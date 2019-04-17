<?php

$I = new ApiTester($scenario);

$review = $I->wantToCreateReview();

$I->wantTo('delete review');
$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendDELETE('reviews/'.$review['id']);
$I->seeResponseCodeIs(204);
