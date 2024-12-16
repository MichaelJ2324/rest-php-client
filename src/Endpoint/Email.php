<?php

namespace Sugarcrm\REST\Endpoint;

use GuzzleHttp\Promise\Utils;
use Sugarcrm\REST\Endpoint\Traits\NoteAttachmentsTrait;
use Sugarcrm\REST\Endpoint\Traits\ParseFilesTrait;

class Email extends Module
{
    use NoteAttachmentsTrait;
    use ParseFilesTrait;
    protected $_beanName = 'Emails';

    protected array $_to = [];

    protected array $_cc = [];

    protected array $_bcc = [];

    /**
     * Pass in an array of files, to attach to current(or new) Bean
     * @param array $files
     * @return $this
     */
    public function addAttachments(array $files, bool $async = true)
    {
        $parsed = $this->parseFiles($files);
        if (!empty($parsed)) {
            $promises = [];
            foreach ($parsed as $file) {
                $Note = new Note();
                $Note->setClient($this->getClient());
                $Note->tempFile(Note::NOTES_FILE_FIELD, $file['path'], true, $file['name']);
                if ($async) {
                    $promises[] = $Note->asyncExecute()->getPromise();
                } else {
                    $Note->execute();
                    $this->parseAttachmentUploadResponse($Note->getResponseBody());
                }
            }
            if ($async) {
                $responses = Utils::unwrap($promises);
                foreach ($responses as $response) {
                    $Note = new Note();
                    $Note->setResponse($response);
                    $this->parseAttachmentUploadResponse($Note->getResponseBody());
                }
            }
        }
        return $this;
    }
}
