<?php
class CMailer
{
    var $content_type = "text/plain";			// тип
    var $charset = "win-1251";					// кодировка
    var $content_transfer_encoding = "8bit";	// шифрование
    var $custom_headers = array();				// пользовательские заголовки
    var $from;
    var $to;
    var $subject;
    var $text;
    var $tags=array();
	
	function __construct($from_em = '', $from_text = '', $to_em = '', $to_text = '', $subject = '', $text = '', $mail_now = false)
	{
		$this->SetFrom($from_em, $from_text);
		$this->SetTo($to_em, $to_text);
		$this->SetSubject($subject);
		$this->SetText($text);
		if ($mail_now)
		{
			$this->Send();
		}
	}
        
    function SetContentType($content_type = "text/plain")
    {
        $this->content_type=$content_type;
    }

    function SetCharset($charset = "win-1251")
    {
        $this->charset=$charset;
    }

    function SetContentTransferEncoding($cte = "8bit")
    {
        $this->content_transfer_encoding=$cte;
    }

    function SetCustomHeaders($custom_header = '')
    {
		if($custom_header != '')
		{
			$this->custom_headers[] = $custom_header;
		}
    }

    function SetFrom($from_em, $from_text='')
    {
        $this->from=$from_text.' <'.$from_em.'>';
    }
        
    function SetTo($to_em, $to_text='')
    {
        $this->to=$to_text.' <'.$to_em.'>';
    }
        
    function SetText($text)
    {
        $this->text=trim($text);
    }
        
    function SetSubject($subject)
    {
        $this->subject=trim($subject);
    }
        
    function SetTag($name, $value)
    {
        $tags[$name]=$value;
    }
        
    function Send()
    {
        if (!empty($this->to))
        {
            $subj=$this->subject;
            $body=$this->text;
            $from=$this->from;
            $to=$this->to;
            foreach ($this->tags as $name=>$value)
            {
                $subj=str_replace('{'.$name.'}', $value, $subj);
                $body=str_replace('{'.$name.'}', $value, $body);
                $from=str_replace('{'.$name.'}', $value, $from);
                $to=str_replace('{'.$name.'}', $value, $to);
            }
            
            $headers="From: ".$from."\n";
            $headers.="Content-Type: " . $this->content_type . "; charset=\"" . $this->charset . "\"\n";
            $headers.="Content-Transfer-Encoding: " . $this->content_transfer_encoding . "\n";

            foreach ($this->custom_headers as $value)
            {
				$headers .= $value."\n";
            }
            $headers .= "\n";
			
            return @mail($to, $subj, $body, $headers);
        }
    }
}
?>                                                                              
