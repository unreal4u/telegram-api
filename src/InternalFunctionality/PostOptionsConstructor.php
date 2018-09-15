<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\InternalFunctionality;

use MultipartBuilder\Builder;
use MultipartBuilder\MultipartData;
use Psr\Log\LoggerInterface;
use unreal4u\Dummy\Logger;
use unreal4u\TelegramAPI\Abstracts\TelegramMethods;
use unreal4u\TelegramAPI\Telegram\Types\Custom\InputFile;
use unreal4u\TelegramAPI\Telegram\Types\InputMedia\Photo;

class PostOptionsConstructor
{
    /**
     * With this flag we'll know what type of request to send to Telegram
     *
     * 'application/x-www-form-urlencoded' is the "normal" one, which is simpler and quicker.
     * 'multipart/form-data' should be used only when you upload documents, photos, etc.
     *
     * @var string
     */
    public $formType = 'application/x-www-form-urlencoded';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new Logger();
        }
        $this->logger = $logger;
    }

    /**
     * Builds up the form elements to be sent to Telegram
     *
     * @TODO Move this to apart function
     *
     * @param TelegramMethods $method
     * @return array
     * @throws \unreal4u\TelegramAPI\Exceptions\MissingMandatoryField
     */
    public function constructOptions(TelegramMethods $method): array
    {
        $result = $this->checkIsMultipart($method);

        if (!empty($result)) {
            return $this->constructMultipartOptions(
                $method->export(),
                /*$result['id'],
                $result['stream'],
                $result['filename']*/
                $result
            );
        }

        $body = http_build_query($method->export(), '', '&');
        
        return [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Content-Length' => \strlen($body),
                'User-Agent' => 'PHP7+ Bot API',
            ],
            'body' => $body
        ];
    }

    /**
     * Check if the given TelegramMethod should be handled as a multipart.
     *
     * @param TelegramMethods $method
     * @return array
     */
    private function checkIsMultipart(TelegramMethods $method): array
    {
        $this->logger->debug('Checking whether to apply special conditions to this request');
        $method->performSpecialConditions();

        $return = [];
//echo "======================================= method ".json_encode($method)."\n";
        foreach ($method as $key => $value) {
//echo "======================================= key ".$key."\n";
//echo "======================================= value ".json_encode($value)."\n";
            if ((\is_object($value) && $value instanceof InputFile)||(\is_object($value) && $value instanceof Photo)||((is_array($value) || $value instanceof Countable) && \count($value)>1 && (reset($value) instanceof InputFile||reset($value) instanceof Photo))) {
                $this->logger->debug('About to send a file, so changing request to use multi-part instead');
                // If we are about to send a file, we must use the multipart/form-data way
                $this->formType = 'multipart/form-data';
                if($value instanceof InputFile){
                  $return[$key] = [
                      'id' => $key,
                      'filename' => $value->path,
                      'stream' => $value->getStream()
                  ];
                }elseif($value instanceof Photo){
                   $return[$key] = [
                      'id' => $key,
                      'filename' => $value->media->path,
                      'stream' => $value->media->getStream()
                  ];
                }elseif((is_array($value) || $value instanceof Countable)){
                  foreach ($value as $kk => $vv){
                  //echo "======================================= kk ".$kk."\n";
                  //echo "======================================= vv \n";
                  var_dump($vv);
                  //echo "======================================= vv END\n";
                  if($vv instanceof InputFile){// echo "################# QUI 1 \n";
                   $return[$kk] = [
                      'id' => $kk,
                      'filename' => $vv->path,
                      'stream' => $vv->getStream()
                  ];
                }elseif($vv instanceof Photo){// echo "################# QUI 2 \n";
                    $return[$kk] = [
                      'id' => $kk,
                      'filename' => $vv->media->path,
                      'stream' => $vv->media->getStream()
                  ];
                  }
                  }
                }
            }
           /* if (\is_object($value) && $value instanceof MediaGroup) {
                $this->logger->debug('About to send a media group, so changing request to use multi-part instead');
                // If we are about to send a file, we must use the multipart/form-data way
                $this->formType = 'multipart/form-data';
                foreach ($file_el as $key => $value){
                  $return[$key] = [
                      'id' => $key,
                      'filename' => $value->path,
                      'stream' => $value->getStream()
                  ];
                }
            }*/
        }

        //echo "================================= checkIsMultipart return \n";
        //var_dump($return);
        //echo "================================= checkIsMultipart return END \n";
        return $return;
    }

    /**
     * Builds up a multipart form-like array for Guzzle
     *
     * @param array $data The original object in array form
     * @param string $fileKeyName A file handler will be sent instead of a string, state here which field it is
     * @param resource $stream The actual file handler
     * @param string $filename
     * @return array Returns the actual formdata to be sent
     */
    public function constructMultipartOptions(array $data, array $multipart_data): array
    // public function constructMultipartOptions(array $data,string $fileKeyName, $stream, string $filename): array
    {
        $builder = new Builder();
        $this->logger->debug('Creating multi-part form array data (complex and expensive)');
                echo "================================ multipart_data \n";
                var_dump($multipart_data);
                echo "\n ================================ multipart_data END \n";
        foreach ($data as $id => $value) {
            /*if ($id === $fileKeyName) {
                $data = new MultipartData(
                    (string) $id,
                    stream_get_contents($stream),
                    pathinfo($filename, PATHINFO_BASENAME)
                );*/
                echo "================================ id ".$id." \n";
                echo "================================ value \n";
                var_dump($value);
                echo "\n ================================ value END \n";
              if (array_key_exists($id,$multipart_data)) {
                $data = new MultipartData(
                    (string) $multipart_data[$id]['id'],
                    stream_get_contents($multipart_data[$id]['stream']),
                    pathinfo($multipart_data[$id]['filename'], PATHINFO_BASENAME)
                );
                $builder->append($data);
            } elseif($id=='mediagroup') {
            echo "================================ DOING MEDIA \n";
               foreach($multipart_data as $ii => $mdata){
                echo "================================ mdata \n";
                var_dump($mdata);
                echo "\n================================ mdata END \n";
                $data = new MultipartData(
                    //(string) $ii,
                    pathinfo($mdata['filename'], PATHINFO_BASENAME),
                    stream_get_contents($mdata['stream']),
                    pathinfo($mdata['filename'], PATHINFO_BASENAME)
                );
                $builder->append($data);
               }
               echo "\n================================ DOING MEDIA END \n";
               //echo "================================ builder \n";
               //var_dump($builder);
                //echo "\n ================================ builder END \n";
            } else {
                echo "================================ value \n";
                var_dump($value);
                echo "\n ================================ value END \n";
                $data = new MultipartData((string) $id, (string) $value);
                $builder->append($data);
                //$data = new MultipartData((string) $id, $value->get_stream(), pathinfo($value->path, PATHINFO_BASENAME));
            }
            
            //$builder->append($data);
        }

        $body = $builder->buildAll();
        $array = [
            'headers' => [
                'Content-Type' => 'multipart/form-data; boundary="' . $builder->getBoundary() . '"',
                'Content-Length' => \strlen($body)
            ],
            'body' => $body
        ];
        return $array;
    }
}
