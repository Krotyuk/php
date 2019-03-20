    public function actionPhoneLike() {
        $userPhone = Users::find()->select('phone')
            ->groupBy('phone')->asArray()->all();
        $NumberPhone = [];
        $LikePhone = [];

        foreach ($userPhone as $dirtynNumberPhone){
            if ($dirtynNumberPhone["phone"] != Null && substr($dirtynNumberPhone["phone"], 1, 2) == '79'){
                $NumberPhone[] = $dirtynNumberPhone["phone"];

            }
        }
        for ($i = 0; $i < count($NumberPhone); $i++){
            if ($i+1 != count($NumberPhone)){
            similar_text($NumberPhone[$i], $NumberPhone[$i+1],$perc);
                if ($perc > 91 && substr($NumberPhone[$i],0,10)==substr($NumberPhone[$i+1],0,10)){
                    $LikePhone[] = [$NumberPhone[$i],$NumberPhone[$i+1],$perc];
                }
            }
        }
        echo count($LikePhone);
        echo "<br>";
        echo count($NumberPhone);
        echo "<pre>";
        var_dump($LikePhone);
        echo "</pre>";

    }
