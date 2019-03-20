    public function actionCheckStop() {
        $summ = 0;
        $summCommis = 0;
        $count = 0;
        $countCommis = 0;

        //Выбрать карты у которых нужно провести списание new

        $dates[] = date('d', strtotime('-1 day'));

        // если сегодня 1 число, а в предыдущем месяце меньше чем 31 день, то добавляем в массив пропущенные числа
        if (date('d', strtotime('-1 day')) != 31 && date('d') == 1) {
            $tmpDate = date('d', strtotime('-1 day')) + 1;
            while ($tmpDate <= 31) {
                $dates[] = $tmpDate;
                $tmpDate++;
            }
        }

        $cards = Cards::find()->where([
            'and',
            [
                'or',
                ['>', 'payment', 0],
                ['>', 'price', 0],
            ],
            [
                'or',
                ['in', 'date_format(created_at, "%d")', $dates],
                ['in', 'date_format(expires_at, "%d")', $dates],
            ],
            ['=', 'status', 1],
        ])->createCommand()->getRawSql();
        echo $cards;
    }
