<?php

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
 */
class ApiTester extends \Codeception\Actor
{

    use _generated\ApiTesterActions;

    /*
     * Create review
     */
    public function wantToCreateReview()
    {
        $data = [
            'name'  => 'Hristian Ilioski',
            'text'  => 'Integration test review text...',
            'score' => 5,
        ];

        $I=$this;
        $I->wantTo('create review');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('reviews', $data);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->canSeeResponseIsValidOnSchemaFile(codecept_data_dir('review.json'));

        return json_decode($I->grabResponse(), true);
    }

}
