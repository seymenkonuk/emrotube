<?php
// ============================================================================
// File:    ChannelRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Enums\SubscribeType;
use Seymen\PhpMvcTemplate\Models\Channel;
use Seymen\PhpMvcTemplate\Models\ChannelDetail;
use Seymen\PhpMvcTemplate\Models\ChannelEdit;
use Seymen\PhpMvcTemplate\Models\ChannelHeader;
use Seymen\PhpMvcTemplate\Models\UserAuth;


class ChannelRepository extends Repository
{
    /**
     * Bu koda sahip kanal olup olmadığını döner.
     * @param string $code
     * @return bool
     */
    public function existsByCode(string $code): bool
    {
        $sql = "SELECT 1 FROM vw_channel_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Kanal sahibi kullanıcının kodunu döner.
     * @param string $code
     * @return string kanal bulunamazsa "" döner.
     */
    public function getUserCodeByChannelCode(string $code): string
    {
        $sql = "SELECT user_code FROM vw_channels WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        return (string) $stmt->fetchColumn();
    }

    /**
     * Kanalın edit detaylarını getirir.
     * @param string $code
     * @return ?ChannelEdit
     */
    public function getChannelForEditing(string $code): ?ChannelEdit
    {
        $sql = "SELECT * FROM vw_channel_edit WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, ChannelEdit::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Kanalın detaylarını getirir.
     * @param string $code
     * @return ?ChannelDetail
     */
    public function getChannelDetailsByCode(string $code): ?ChannelDetail
    {
        $sql = "SELECT * FROM vw_channel_details WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, ChannelDetail::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * İlgili kanalın header bilgilerini döner.
     * @param string $code
     * @param ?UserAuth $auth
     * @return ?ChannelHeader
     */
    public function getChannelHeaderByCode(string $code, ?UserAuth $auth): ?ChannelHeader
    {
        if (!isset($auth)) {
            $result = $this->getChannelHeaderByCodeWithNoAuth($code);
        } else {
            $result = $this->getChannelHeaderByCodeWithAuth($code, $auth);
        }
        return $result;
    }

    /**
     * Kanal sayısını döner.
     * @return int
     */
    public function getCountChannels(): int
    {
        $sql = "SELECT COUNT(*) FROM vw_channels";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * Tüm kanalları sayfalama yaparak getirir.
     * @param ?UserAuth $auth
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Channel>
     */
    public function getPaginatedChannels(?UserAuth $auth, int $offset, int $limit): \Generator
    {
        if (!isset($auth)) {
            return $this->getPaginatedChannelsWithNoAuth($offset, $limit);
        } else {
            return $this->getPaginatedChannelsWithAuth($auth, $offset, $limit);
        }
    }

    /**
     * İlgili kullanıcının oluşturduğu tüm kanal sayısını döner.
     * @param string $userCode
     * @return int
     */
    public function getCountMyChannelsByUserCode(string $userCode): int
    {
        $sql = "SELECT COUNT(*) FROM vw_channels WHERE user_code = :userCode";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':userCode', $userCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın oluşturduğu tüm kanalları sayfalama yaparak getirir.
     * @param string    $userCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Channel>
     */
    public function getPaginatedMyChannelsByUserCode(string $userCode, int $offset, int $limit): \Generator
    {
        $sql = "SELECT * FROM vw_channels WHERE user_code = :userCode ORDER BY date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':userCode', $userCode);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Channel::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }

    /**
     * İlgili kanalın header bilgilerini oturum açan kullanıcıya göre döner.
     * @param string $code
     * @param UserAuth $auth
     * @return ?ChannelHeader
     */
    private function getChannelHeaderByCodeWithAuth(string $code, UserAuth $auth): ?ChannelHeader
    {
        return $this->getChannelHeaderByCodeWithNoAuth($code);
        error;
        // $sql = "
        //     SELECT c.*,  IF(s.subscriber_code IS NOT NULL, 1, 0) AS is_subscribed, s.type as subscription_type, s.subscribe_title
        //     FROM vw_channel_header c
        //     LEFT JOIN vw_subscription s ON s.subscribed_code = c.code AND s.subscriber_code = :authCode
        //     WHERE c.code = :code
        //     LIMIT 1";
        // $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':code', $code);
        // $stmt->bindValue(':authCode', $auth->code);
        // $stmt->execute();
        // $stmt->setFetchMode(\PDO::FETCH_CLASS, ChannelHeader::class);
        // return $stmt->fetch() ?: null;
    }

    /**
     * İlgili kanalın header bilgilerini misafir kullanıcıya göre döner.
     * @param string $code
     * @return ?ChannelHeader
     */
    private function getChannelHeaderByCodeWithNoAuth(string $code): ?ChannelHeader
    {
        $subscription_type = SubscribeType::GUEST_SUBSCRIBE_NOT_ALLOWED->value;
        $sql = "SELECT *, $subscription_type subscription_type, null subscription_title FROM vw_channel_header WHERE code = :code LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, ChannelHeader::class);
        return $stmt->fetch() ?: null;
    }

    /**
     * Tüm kanalları oturum açan kullanıcıya göre sayfalama yaparak getirir.
     * @param UserAuth $auth
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Channel>
     */
    private function getPaginatedChannelsWithAuth(UserAuth $auth, int $offset, int $limit): \Generator
    {
        return $this->getPaginatedChannelsWithNoAuth($offset, $limit);
        error;
        // $sql = "
        //     SELECT c.*, IF(s.subscriber_code IS NOT NULL, 1, 0) AS is_subscribed, s.type as subscription_type, s.subscribe_title
        //     FROM vw_channels c
        //     LEFT JOIN vw_subscription s ON s.subscribed_code = c.code AND s.subscriber_code = :authCode
        //     ORDER BY c.date DESC
        //     LIMIT :limit OFFSET :offset
        // ";
        // $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        // $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        // $stmt->bindValue(':authCode', $authCode);
        // $stmt->execute();
        // $stmt->setFetchMode(\PDO::FETCH_CLASS, Channel::class);
        // while ($row = $stmt->fetch()) {
        //     yield $row;
        // }
    }

    /**
     * Tüm kanalları misafir kullanıcıya göre sayfalama yaparak getirir.
     * @param UserAuth $auth
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Channel>
     */
    private function getPaginatedChannelsWithNoAuth(int $offset, int $limit): \Generator
    {
        $subscription_type = SubscribeType::GUEST_SUBSCRIBE_NOT_ALLOWED->value;
        $sql = "SELECT *, $subscription_type subscription_type, null subscription_title FROM vw_channels ORDER BY date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Channel::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }
}
