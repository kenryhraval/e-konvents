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
    'accepted' => ':attribute laukam jābūt apstiprinātam.',
    'accepted_if' => ':attribute laukam jābūt apstiprinātam, kad :other ir :value.',
    'active_url' => ':attribute laukam jābūt derīgam URL.',
    'after' => ':attribute laukam jābūt datumam pēc :date.',
    'after_or_equal' => ':attribute laukam jābūt datumam pēc vai vienādam ar :date.',
    'alpha' => ':attribute laukā drīkst būt tikai burti.',
    'alpha_dash' => ':attribute laukā drīkst būt tikai burti, cipari, domuzīmes un pasvītras.',
    'alpha_num' => ':attribute laukā drīkst būt tikai burti un cipari.',
    'array' => ':attribute laukam jābūt masīvam.',
    'ascii' => ':attribute laukā drīkst būt tikai vienbaitu alfabēta simboli un zīmes.',
    'before' => ':attribute laukam jābūt datumam pirms :date.',
    'before_or_equal' => ':attribute laukam jābūt datumam pirms vai vienādam ar :date.',
    'between' => [
        'numeric' => ':attribute laukam jābūt no :min līdz :max.',
        'file' => ':attribute faila izmēram jābūt no :min līdz :max kilobaitiem.',
        'string' => ':attribute laukam jābūt no :min līdz :max rakstzīmēm.',
        'array' => ':attribute masīvam jābūt ar :min līdz :max vienumiem.',
    ],
    'boolean' => ':attribute laukam jābūt patiesam vai aplamam.',
    'confirmed' => ':attribute apstiprinājums nesakrīt.',
    'current_password' => 'Parole ir nepareiza.',
    'date' => ':attribute laukam jābūt derīgam datumam.',
    'date_equals' => ':attribute laukam jābūt datumam, kas vienāds ar :date.',
    'date_format' => ':attribute lauks neatbilst formātam :format.',
    'email' => ':attribute laukam jābūt derīgai e-pasta adresei.',
    'exists' => 'Izvēlētais :attribute nav derīgs.',
    'file' => ':attribute laukam jābūt failam.',
    'filled' => ':attribute laukam jābūt aizpildītam.',
    'image' => ':attribute laukam jābūt attēlam.',
    'in' => 'Izvēlētais :attribute nav derīgs.',
    'integer' => ':attribute laukam jābūt veselam skaitlim.',
    'ip' => ':attribute laukam jābūt derīgai IP adresei.',
    'json' => ':attribute laukam jābūt derīgai JSON virknei.',
    'max' => [
        'numeric' => ':attribute laukam jābūt ne vairāk kā :max.',
        'file' => ':attribute faila izmērs nedrīkst pārsniegt :max kilobaitus.',
        'string' => ':attribute laukā nedrīkst būt vairāk par :max rakstzīmēm.',
        'array' => ':attribute masīvā nedrīkst būt vairāk par :max vienumiem.',
    ],
    'min' => [
        'numeric' => ':attribute laukam jābūt vismaz :min.',
        'file' => ':attribute faila izmēram jābūt vismaz :min kilobaitiem.',
        'string' => ':attribute laukā jābūt vismaz :min rakstzīmēm.',
        'array' => ':attribute masīvā jābūt vismaz :min vienumiem.',
    ],
    'not_in' => 'Izvēlētais :attribute nav derīgs.',
    'numeric' => ':attribute laukam jābūt skaitlim.',
    'required' => ':attribute lauks ir obligāts.',
    'same' => ':attribute un :other laukiem jāsakrīt.',
    'size' => [
        'numeric' => ':attribute laukam jābūt :size.',
        'file' => ':attribute faila izmēram jābūt :size kilobaiti.',
        'string' => ':attribute laukā jābūt :size rakstzīmēm.',
        'array' => ':attribute masīvā jābūt :size vienumiem.',
    ],
    'string' => ':attribute laukam jābūt virknei.',
    'unique' => ':attribute jau ir aizņemts.',
    'url' => ':attribute laukam jābūt derīgam URL.',


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

    'attributes' => [],

];
