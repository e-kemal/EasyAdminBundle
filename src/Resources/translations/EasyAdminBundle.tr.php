<?php

return [
    'page_title' => [
        // 'dashboard' => '',
        'detail' => '%entity_label_singular% (#%entity_id%)',
        'edit' => '%entity_label_singular% (#%entity_id%) Düzenle',
        'index' => '%entity_label_plural%',
        'new' => 'Oluştur : %entity_label_singular%',
        'exception' => 'Hata|Hatalar',
    ],

    'datagrid' => [
        // 'hidden_results' => '',
        'no_results' => 'Sonuç bulunamadı.',
    ],

    'paginator' => [
        'first' => 'İlk',
        'previous' => 'Önceki',
        'next' => 'Sonraki',
        'last' => 'Son',
        'counter' => '<strong>%results%</strong> öğeden <strong>%start%</strong> - <strong>%end%</strong> arası',
        'results' => '{0} Sonuç yok|{1} <strong>1</strong> sonuç|]1,Inf] <strong>%count%</strong> sonuç',
    ],

    'label' => [
        'true' => 'Evet',
        'false' => 'Hayır',
        'empty' => 'Boş',
        'null' => 'Boş',
        'nullable_field' => 'Boş Bırakabilirsiniz',
        'object' => 'PHP Objesi',
        'inaccessible' => 'Erişilemez',
        'inaccessible.explanation' => 'Özelliğin getter methodu tanımlanmamış veya özellik public değil',
        'form.empty_value' => 'Boş',
    ],

    'property' => [
        // 'code_editor.view_code' => '',
        // 'text_editor.view_content' => '',
    ],

    'action' => [
        'entity_actions' => 'İşlemler',
        'new' => '%entity_label_singular% Oluştur',
        'search' => 'Ara',
        'detail' => 'Göster',
        'edit' => 'Düzenle',
        'delete' => 'Sil',
        'cancel' => 'İptal',
        'index' => 'Listeye Dön',
        // 'deselect' => '',
        'add_new_item' => 'Yeni öğe ekle',
        'remove_item' => 'Öğeyi Sil',
        'choose_file' => 'Dosya Seç',
        // 'close' => '',
        // 'create' => '',
        // 'create_and_add_another' => '',
        // 'create_and_continue' => '',
        // 'save' => '',
        // 'save_and_continue' => '',
    ],

    'batch_action_modal' => [
        'title' => 'Seçili öğeleri değiştirmek istediğinize emin misiniz?',
        'content' => 'Bu işlem geri alınamaz.',
        'action' => 'İlerle',
    ],

    'delete_modal' => [
        'title' => 'Bu öğeyi silmek istediğinize emin misiniz?',
        'content' => 'Bu işlem geri alınamaz.',
    ],

    'filter' => [
        'title' => 'Filtreler',
        'button.clear' => 'Temizle',
        'button.apply' => 'Uygula',
        'label.is_equal_to' => 'Eşittir',
        'label.is_not_equal_to' => 'Eşit değildir',
        'label.is_greater_than' => 'Büyüktür',
        'label.is_greater_than_or_equal_to' => 'Büyüktür veya eşittir',
        'label.is_less_than' => 'Küçüktür',
        'label.is_less_than_or_equal_to' => 'Küçüktür veya eşittir',
        // 'label.is_between' => '',
        'label.contains' => 'Metin şunları içeriyor',
        'label.not_contains' => 'Metin şunları içermiyor',
        'label.starts_with' => 'Metin şununla başlıyor',
        'label.ends_with' => 'Metin şununla bitiyor',
        'label.exactly' => 'Metin aynı',
        'label.not_exactly' => 'Metin aynı değil',
        'label.is_same' => 'Aynı',
        'label.is_not_same' => 'Aynı değil',
        'label.is_after' => 'Tarihinden sonra',
        'label.is_after_or_same' => 'Tarihi ve sonrası',
        'label.is_before' => 'Tarihinden önce',
        'label.is_before_or_same' => 'Tarihi ve öncesi',
    ],

    'form' => [
        'are_you_sure' => 'Formdaki değişiklikleri kaydetmediniz.',
        'tab.error_badge_title' => 'Bir geçersiz girdi|%count% geçersiz girdi',
    ],

    'user' => [
        'logged_in_as' => 'Kullanıcı : ',
        'unnamed' => 'İsimsiz Kullanıcı',
        'anonymous' => 'Anonim Kullanıcı',
        'sign_out' => 'Çıkış',
        'exit_impersonation' => 'Canlandırma modundan çık',
    ],

    'login_page' => [
        'username' => 'Kullanıcı adı',
        'password' => 'Şifre',
        'sign_in' => 'Giriş yap',
    ],

    'exception' => [
        'entity_not_found' => 'Bu öğe artık mevcut değil.',
        'entity_remove' => 'Diğer öğeler buna bağlı olduğu için bu öğe silinemiyor.',
        'forbidden_action' => 'İstenen eylem bu öğe üzerinde gerçekleştirilemez.',
    ],
];
