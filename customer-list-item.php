<?php foreach ($records as $record): ?>
    <div class="p-customer__center__record-list__item">
        <span>
            <img src="./img/man.svg" alt="">
        </span>
        <div class="p-customer__center__record-list__item__main">
            <div class="p-customer__center__record-list__item__main__heading">
                <div class="p-customer__center__record-list__item__main__heading__name">
                    <p><?= htmlspecialchars($record['fieldData']['t_契約者名'] ?? '') ?></p>
                    <p>管理番号：<?= htmlspecialchars($record['fieldData']['n_管理番号'] ?? '') ?></p>
                </div>

                <div class="p-customer__center__record-list__item__main__heading__status">
                    <div class="p-customer__center__record-list__item__main__heading__status__item">
                        <span>ステータス：</span>
                        <p>
                            <?= htmlspecialchars($record['fieldData']['t_エントリーステータス'] ?? '') ?>
                        </p>
                    </div>
                    <div class="p-customer__center__record-list__item__main__heading__status__item">
                        <span>サブステータス：</span>
                        <p>
                            <?= htmlspecialchars($record['fieldData']['t_サブエントリーステータス'] ?? '') ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-customer__center__record-list__item__main__contents">
                <div class="p-customer__center__record-list__item__main__contents__left">
                    <div class="p-customer__center__record-list__item__main__contents__left__tab">
                        <ul class="p-customer__center__record-list__item__main__contents__left__tab__btn">
                            <li class="is-active">アポ情報</li>
                            <li>アトカク情報</li>
                            <li>キャンセル理由</li>
                        </ul>

                        <div class="p-customer__center__record-list__item__main__contents__left__tab__panel">
                            <!-- アポ情報 -->
                            <table class="is-active">
                                <tr>
                                    <td>コール希望日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_アポイント希望日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>コール希望時間：</td>
                                    <td>
                                        <?php
                                        $rawTime = $record['fieldData']['ti_アポイント希望時間1'] ?? '';

                                        $formattedTime = '';
                                        if (!empty($rawTime)) {
                                            $timeObj = DateTime::createFromFormat('H:i:s', $rawTime);
                                            $formattedTime = $timeObj ? $timeObj->format('G:i') : htmlspecialchars($rawTime);
                                        }

                                        echo $formattedTime;
                                        ?> ~
                                        <?php
                                        $rawTime = $record['fieldData']['ti_アポイント希望時間2'] ?? '';

                                        $formattedTime = '';
                                        if (!empty($rawTime)) {
                                            $timeObj = DateTime::createFromFormat('H:i:s', $rawTime);
                                            $formattedTime = $timeObj ? $timeObj->format('G:i') : htmlspecialchars($rawTime);
                                        }
                                        echo $formattedTime;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>築年数：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_築年数'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>アポ種別：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_アポ種別'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>保険会社：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_保険会社証書'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>お客様情報：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_アポイント備考'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ネガ：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_ネガ'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ネガ返し：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_ネガ返し'] ?? '') ?>
                                    </td>
                                </tr>
                            </table>

                            <!-- アトカク情報 -->
                            <table>
                                <tr>
                                    <td>アトカク担当者：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_確認電話担当者'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>現地調査予定日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_現地調査予定日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>訪問時間：</td>
                                    <td>
                                        <?php
                                        $rawTime = $record['fieldData']['ti_現地調査時間1'] ?? '';

                                        $formattedTime = '';
                                        if (!empty($rawTime)) {
                                            $timeObj = DateTime::createFromFormat('H:i:s', $rawTime);
                                            $formattedTime = $timeObj ? $timeObj->format('G:i') : htmlspecialchars($rawTime);
                                        }

                                        echo $formattedTime;
                                        ?> ~
                                        <?php
                                        $rawTime = $record['fieldData']['ti_現地調査時間2'] ?? '';

                                        $formattedTime = '';
                                        if (!empty($rawTime)) {
                                            $timeObj = DateTime::createFromFormat('H:i:s', $rawTime);
                                            $formattedTime = $timeObj ? $timeObj->format('G:i') : htmlspecialchars($rawTime);
                                        }
                                        echo $formattedTime;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>現地調査完了日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_現地調査完了日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>備考：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_アトカク備考'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>年齢層：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_年齢層'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>受注日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_受注日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>アトカク者メモ：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_アポイントmemo'] ?? '') ?>
                                    </td>
                                </tr>
                            </table>

                            <!-- キャンセル情報 -->
                            <table>
                                <tr>
                                    <td>アトカクキャンセル日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_アトカク現調前キャンセル日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>現調前キャンセル日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_現調前キャンセル日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>現調以降キャンセル日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_現調以降キャンセル日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>クロージング以降キャンセル日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_クロージング以降キャンセル日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>キャンセルセグメント：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_キャンセルセグメント'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>キャンセル理由詳細：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_キャンセル理由'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>受注日：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['d_受注日'] ?? '') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>アトカク者メモ：</td>
                                    <td>
                                        <?= htmlspecialchars($record['fieldData']['t_アポイントmemo'] ?? '') ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="p-customer__center__record-list__item__main__contents__right">
                    <table>
                        <tr>
                            <td>受付日：</td>
                            <td><?= htmlspecialchars($record['fieldData']['d_受付日'] ?? '') ?></td>

                        </tr>
                        <tr>
                            <td>受付時間：</td>
                            <td><?= htmlspecialchars($record['fieldData']['ti_受付時間'] ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>担当：</td>
                            <td><?= htmlspecialchars($record['fieldData']['t_アポ担当者'] ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>支店：</td>
                            <td><?= htmlspecialchars($record['fieldData']['t_支店判別'] ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>確認者：</td>
                            <td><?= htmlspecialchars($record['fieldData']['t_確認者'] ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>固定電話：</td>
                            <td><?= htmlspecialchars($record['fieldData']['cn_固定電話番号'] ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>携帯電話：</td>
                            <td><?= htmlspecialchars($record['fieldData']['cn_携帯電話番号'] ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>メールアドレス：</td>
                            <td><?= htmlspecialchars($record['fieldData']['t_Email'] ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>郵便番号：</td>
                            <td>〒<?= htmlspecialchars($record['fieldData']['t_郵便番号'] ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>住所：</td>
                            <td><?= htmlspecialchars($record['fieldData']['t_施工先住所'] ?? '') ?></td>
                        </tr>
                    </table>

                    <a href="detail.php?id=<?= htmlspecialchars($record['recordId']) ?>">詳細</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>