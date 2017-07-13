<?php

namespace Codeages\Biz\Framework\Security\Service;

interface SessionManage
{
    public function createSession($session);

    public function getSessionBySessionId($sessionId);

    public function deleteSessionBySessionId($sessionId);

    public function deleteSessionsByUserId($userId);

    public function deleteInvalidSession($sessionTime);

    public function countOnline($retentionTime);

    public function countLogin($retentionTime);
}