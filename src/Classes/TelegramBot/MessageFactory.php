<?php

namespace Navid\TelegramTetherBot\Classes\TelegramBot;

use \Classes\ViewLayer\PriceTableRenderer;
use \Hekmatinasser\Verta\Verta;
class MessageFactory
{
    // how approprietly send prices to telegram
    private $bot_token;
    private $group_id;
    public $message;

    private function fa_number($number)
    {
       if(!is_numeric($number) || empty($number))
       return '۰';
       $en = array("0","1","2","3","4","5","6","7","8","9");
       $fa = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
       return str_replace($en, $fa, $number);
    }

    private function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_LEFT, $encoding = 'UTF-8')
    {
        $input_length = mb_strlen($input, $encoding);
        $pad_string_length = mb_strlen($pad_string, $encoding);
    
        if ($pad_length <= 0 || ($pad_length - $input_length) <= 0) {
            return $input;
        }
    
        $num_pad_chars = $pad_length - $input_length;
    
        switch ($pad_type) {
            case STR_PAD_RIGHT:
                $center_pad = 0;
                $center_pad = $num_pad_chars;
                break;
    
            case STR_PAD_LEFT:
                $center_pad = $num_pad_chars;
                $center_pad = 0;
                break;
    
            case STR_PAD_BOTH:
                $center_pad = floor($num_pad_chars / 2);
                $center_pad = $num_pad_chars - $center_pad;
                break;
        }
    
        $result = '';
        for ($i = 0; $i < $center_pad; ++$i) {
            $result .= mb_substr($pad_string, $i % $pad_string_length, 1, $encoding);
        }
        $result .= $input;
        for ($i = 0; $i < $center_pad; ++$i) {
            $result .= mb_substr($pad_string, $i % $pad_string_length, 1, $encoding);
        }
    
        return $result;
    }

    public function getTabularRepresentation($msg)
    {
        // $builder = new \AsciiTable\Builder();
        $table = (new \Laminas\Text\Table\Table([
            'columnWidths' => [12, 8, 8],
            'AutoSeparate' => \Laminas\Text\Table\Table::AUTO_SEPARATE_HEADER
        ]))->setDecorator(new \Laminas\Text\Table\Decorator\Blank);

        $headerRow = $row = (new \Laminas\Text\Table\Row());
        $headerRow->appendColumn(new \Laminas\Text\Table\Column(('صرافی'),'left'));
        $headerRow->appendColumn(new \Laminas\Text\Table\Column(('خرید'),'left'));
        $headerRow->appendColumn(new \Laminas\Text\Table\Column(('فروش'),'left'));
        $table->appendRow($headerRow);

        foreach ($msg as $provider_label => $price_info) {
            $priceRow = $row = new \Laminas\Text\Table\Row();

            $priceRow->appendColumn(new \Laminas\Text\Table\Column(trim($provider_label),'center'));
            $priceRow->appendColumn(new \Laminas\Text\Table\Column( is_numeric(str_replace(',','',trim((string) $price_info['buy']))) ? ($this->fa_number(floatval(str_replace(',','',trim((string) $price_info['buy']))))) : trim((string) $price_info['buy']) ,'center'));
            $priceRow->appendColumn(new \Laminas\Text\Table\Column( is_numeric(str_replace(',','',trim((string) $price_info['sell']))) ? ($this->fa_number(floatval(str_replace(',','',trim((string) $price_info['sell']))))) : trim((string) $price_info['sell']),'center'));

            $table->appendRow($priceRow);
            // $builder->addRow([
            //     str_pad('نام صرافی' ,25, " ", STR_PAD_BOTH) => str_pad($provider_label, 25, " ", STR_PAD_BOTH),
            //     str_pad('قیمت فروش' ,25, " ", STR_PAD_BOTH) => str_pad($price_info['sell'] ,25, " ", STR_PAD_BOTH),
            //     str_pad("قیمت خرید" ,25, " ", STR_PAD_BOTH) => str_pad($price_info['buy'] ,25, " ", STR_PAD_BOTH)
            // ]);        }
            // return $builder->renderTable();
            // | فروش   |      خرید       |       |
            // |----------|:-------------:|------:|
            // | $msg[array_keys($msg)[0]]['buy'] | $msg[array_keys($msg)[0]]['sell'] | array_keys($msg)[0]        |
            // | $msg[array_keys($msg)[1]]['buy'] | $msg[array_keys($msg)[1]]['sell']   | array_keys($msg)[1]        |
            // | $msg[array_keys($msg)[2]]['buy'] | $msg[array_keys($msg)[2]]['sell'] | array_keys($msg)[2]        |
            // | $msg[array_keys($msg)[3]]['buy'] | $msg[array_keys($msg)[3]]['sell'] | array_keys($msg)[3]        |

            // </pre>";
        }
        return str_pad(" ⬇️ بروزرسانی نرخ تتر 🤑🔔",30," ",STR_PAD_LEFT) . "\n\n" .
        ((string) $table) . "\n" ."\xF0\x9F\x93\x86 " . Verta::now('Asia/Tehran')->format('Y-n-j H:i') ."\n" ;
    }
    
}
