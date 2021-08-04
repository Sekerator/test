<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class TestModule extends Module
{
    public function getContent()
    {
        $output = '';

        // this part is executed only when the form is submitted
        if (Tools::isSubmit('submit' . $this->name)) {
            // retrieve the value set by the user
            $configValue = (int) Tools::getValue('first_price');
            $configValue2 = (int) Tools::getValue('second_price');

            if (empty($configValue) || empty($configValue2) || !Validate::isGenericName($configValue) || !Validate::isGenericName($configValue2)) {
                $output = $this->displayError($this->l('Invalid Configuration value'));
            } else {
                Configuration::updateValue('first_price', $configValue);
                Configuration::updateValue('second_price', $configValue2);
                $this->registerHook('footer');
                $output = $this->displayConfirmation($this->l('Settings updated'));
            }
        }

        // display any message, then the form
        return $output . $this->displayForm();
    }

    public function displayForm()
    {
        // Init Fields form array
        $form = [
            'form' => [
                'legend' => [
                    'title' => $this->l('Settings'),
                ],
                'input' => [
                    [
                        'type' => 'text',
                        'label' => $this->l('Цена от'),
                        'name' => 'first_price',
                        'size' => 20,
                        'required' => true,
                    ],
                    [
                        'type' => 'text',
                        'label' => $this->l('Цена до'),
                        'name' => 'second_price',
                        'size' => 20,
                        'required' => true,
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Сохранить'),
                    'class' => 'btn btn-default pull-right',
                ],
            ],
        ];

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->table = $this->table;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&' . http_build_query(['configure' => $this->name]);
        $helper->submit_action = 'submit' . $this->name;

        // Default language
        $helper->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');

        // Load current value into the form
        $helper->fields_value['TESTMODULE_CONFIG'] = Tools::getValue('TESTMODULE_CONFIG', Configuration::get('TESTMODULE_CONFIG'));

        return $helper->generateForm([$form]);
    }

    public function __construct()
    {
        $this->name = 'testmodule';
        $this->tab = 'test';
        $this->version = '1.0.0';
        $this->author = 'Tagi Eynullaev';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Test module');
        $this->description = $this->l('This is test module.');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function hookDisplayFooter($params)
    {
        $fPrice = Configuration::get('first_price');
        $sPrice = Configuration::get('second_price');
        $db = Db::getInstance();
        $request = "SELECT count(*) FROM " . _DB_PREFIX_ . "product WHERE price>" . $fPrice . " AND price<" . $sPrice;
        $count = $db->getValue($request);

        echo $this->displayConfirmation($this->l("Товаров на цену от " . $fPrice . " до " . $sPrice . " ➔ " . $count));
    }
}