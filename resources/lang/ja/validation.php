<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'この項目が未承認です。',
    'accepted_if'          => 'The :attribute must be accepted when :other is :value.',
    'active_url'           => '有効なURLではありません。',
    'after'                => ':dateより後の日付を指定してください。',
    'after_or_equal'       => ':date以降の日付を指定してください。',
    'alpha'                => 'アルファベットのみ使用できます。',
    'alpha_dash'           => '英数字、ハイフン、アンダースコアのみ使用できます。',
    'alpha_num'            => '英数字のみ使用できます。',
    'array'                => '配列でなければなりません。',
    'before'               => ':date より前の日付を指定してください。',
    'before_or_equal'      => ':date 以前の日付を指定してください。',
    'between'              => [
        'array'   => ':min ~ :max 個でなければなりません。',
        'file'    => 'ファイルサイズは :min ~ :max KBの間でなければなりません。',
        'numeric' => ':min ~ :max の間でなければなりません。',
        'string'  => ':min ~ :max 文字の間でなければなりません。',
    ],
    'boolean'              => 'trueまたはfalseを指定してください。',
    'confirmed'            => '確認の内容が一致しません。',
    'current_password'     => 'The password is incorrect.',
    'date'                 => '有効な日付ではありません。',
    'date_equals'          => ':date 同じ日付を指定してください。',
    'date_format'          => ':format の形と一致しません。',
    'declined'             => 'The :attribute must be declined.',
    'declined_if'          => 'The :attribute must be declined when :other is :value.',
    'different'            => ':other とは異なる必要があります。',
    'digits'               => ':digits桁でなければなりません。',
    'digits_between'       => ':min ~ :max桁でなければなりません。',
    'dimensions'           => '画像の寸法が無効です。',
    'distinct'             => '値が重複しています。',
    'email'                => '正しいメールアドレスを入力してください',
    'ends_with'            => '次のいずれかで終わる必要があります: :values',
    'enum'                 => 'The selected :attribute is invalid.',
    'exists'               => '選択した値が無効です。',
    'file'                 => 'ファイルである必要があります。',
    'filled'               => '値がありません。',
    'gt'                   => [
        'numeric' => ':value より大きい必要があります。',
        'file'    => 'ファイルサイズが :value KBより大きい必要があります。',
        'string'  => ':value文字より多い必要があります。',
        'array'   => ':value 個より多くい必要があります。',
    ],
    'gte'                  => [
        'numeric' => ':value 以上でなければなりません。',
        'file'    => 'ファイルサイズが :value KB以上でなければなりません。',
        'string'  => ':value文字以上必要です。',
        'array'   => ':value 個以上でなければなりません。',
    ],
    'image'                => '画像でなければなりません。',
    'in'                   => '選択した値が無効です。',
    'in_array'             => 'この値は:otherに存在しません。',
    'integer'              => '数字でなければなりません。',
    'ip'                   => '有効なIPアドレスである必要があります。',
    'ipv4'                 => '有効なIPv4アドレスである必要があります。',
    'ipv6'                 => '有効なIPv6アドレスである必要があります。',
    'mac_address'          => 'The :attribute must be a valid MAC address.',
    'json'                 => '有効なJSON文字列である必要があります。',
    'lt'                   => [
        'numeric' => ':value より小さくなければなりません。',
        'file'    => 'ファイルサイズが :value KBより小さくなければなりません。',
        'string'  => ':value文字より少なければなりません。',
        'array'   => ':value 個より少なければなりません。',
    ],
    'lte'                  => [
        'numeric' => ':value 以下でなければなりません。',
        'file'    => 'ファイルサイズが :value KB以下でなければなりません。',
        'string'  => ':value文字以下でなければなりません。',
        'array'   => ':value 個以下でなければなりません。',
    ],
    'max'                  => [
        'numeric' => ':max 以下でなければなりません。',
        'file'    => 'ファイルサイズが :value KB以下でなければなりません。',
        'string'  => ':max文字以内で入力してください',
        'array'   => ':max 個以下でなければなりません。',
    ],
    'mimes'                => ':valuesのファイルである必要があります。',
    'mimetypes'            => ':valuesのファイルである必要があります。',
    'min'                  => [
        'numeric' => ':min 以上でなければなりません。',
        'file'    => 'ファイルサイズが :min KB以上でなければなりません。',
        'string'  => ':min文字以上必要です。',
        'array'   => ':min 個以上でなければなりません。',
    ],
    'multiple_of'          => ':valueの倍数でなければなりません。',
    'not_in'               => '選択した値が無効です。',
    'not_regex'            => 'この形式は無効です。',
    'numeric'              => '数字でなければなりません。',
    'password'             => 'パスワードが間違っています。',
    'present'              => 'この項目は必須です。',
    'prohibited'           => 'この項目は禁止されています。',
    'prohibited_if'        => ':otherが:valueの場合、この項目は禁止されています。',
    'prohibited_unless'    => ':otherが:valuesでない限り、この項目は禁止されています。',
    'prohibits'            => 'The :attribute field prohibits :other from being present.',
    'regex'                => 'この形式は無効です。',
    'required'             => 'この項目は必須です',
    'required_if'          => ':otherが:valueの場合、この項目は必須です。',
    'required_unless'      => ':otherが:valuesでない限り、この項目は必須です。',
    'required_with'        => ':valuesが存在する場合、この項目は必須です。',
    'required_with_all'    => ':valuesが存在する場合、この項目は必須です。',
    'required_without'     => ':valuesが存在しない場合、この項目は必須です。',
    'required_without_all' => ':valuesのいずれも存在しない場合、この項目は必須です。',
    'same'                 => ':otherの値と一致しません。',
    'size'                 => [
        'numeric' => ':size でないといけません。',
        'file'    => ':size KBでないといけません。',
        'string'  => ':size 文字でないといけません。',
        'array'   => ':size 個含まれていないといけません。',
    ],
    'starts_with'          => '次のいずれかから始まる必要があります: :values',
    'string'               => '文字でなければなりません。',
    'timezone'             => '有効なタイムゾーンである必要があります。',
    'unique'               => 'すでに使用されています。',
    'uploaded'             => 'アップロードに失敗しました。',
    'url'                  => 'この形式は無効です。',
    'uuid'                 => '有効なUUIDである必要があります。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email'                 => 'メール',
        'password'              => 'パスワード',
        'password_confirmation' => 'パスワードを認証する',
        'photo'                 => 'プロフィールの写真',
        'full_name'             => 'フルネーム',
        'first_name'            => 'ファーストネーム',
        'last_name'             => '苗字',
        'current_password'      => '現在のパスワード',
    ],
];
