<?php
// ============================================================================
// File:    SubscriptionRepository.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Repositories;


use Seymen\PhpMvcTemplate\Core\Repository;
use Seymen\PhpMvcTemplate\Models\Channel;
use Seymen\PhpMvcTemplate\Models\Media;
use Seymen\PhpMvcTemplate\Models\UserAuth;


class SubscriptionRepository extends Repository
{
    /**
     * İlgili kanalın abone olduğu kanal sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountSubscribedChannelsByChannelCode(string $channelCode): int
    {
        error;
        // $sql = "
        //     SELECT COUNT(*)
        //     FROM vw_channels c
        //     JOIN vw_subscription s ON s.subscribed_code = c.code 
        //     WHERE s.subscriber_code = :channelCode
        // ";
        // $stmt = $this->pdo->prepare($sql);
        // $stmt->bindValue(':channelCode', $channelCode);
        // $stmt->execute();
        // return (int) $stmt->fetchColumn();
        return 0;
    }

    /**
     * İlgili kanalın abone olduğu kanalları sayfalama yaparak getirir.
     * @param string $channelCode
     * @param int $offset
     * @param int $limit
     * @param ?UserAuth $auth
     * @return \Generator<int, Channel>
     */
    public function getPaginatedSubscribedChannelsByChannelCode(string $channelCode, int $offset, int $limit, ?UserAuth $auth): \Generator
    {
        if (!isset($auth)) {
            return $this->getPaginatedSubscribedChannelsByChannelCodeWithNoAuth($channelCode, $offset, $limit);
        } else {
            return $this->getPaginatedSubscribedChannelsByChannelCodeWithAuth($channelCode, $offset, $limit, $auth);
        }
    }

    /**
     * Oturum açan kanalın abone olduğu kanal sayısını döner.
     * @param UserAuth $auth
     * @return int
     */
    public function getCountMySubscribedChannelsByChannelCode(UserAuth $auth): int
    {
        return $this->getCountSubscribedChannelsByChannelCode($auth->channel_code);
    }

    /**
     * Oturum açan kanalın abone olduğu kanalları sayfalama yaparak getirir.
     * @param UserAuth $auth
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Channel>
     */
    public function getPaginatedMySubscribedChannelsByChannelCode(UserAuth $auth, int $offset, int $limit): \Generator
    {
        return $this->getPaginatedSubscribedChannelsByChannelCode($auth->channel_code, $offset, $limit, $auth);
    }

    /**
     * İlgili kanalın abone olduğu tüm kanalları misafir kullanıcıya göre sayfalama yaparak getirir.
     * @param string $channelCode
     * @param int $offset
     * @param int $limit
     * @return \Generator<int, Channel>
     */
    private function getPaginatedSubscribedChannelsByChannelCodeWithNoAuth(string $channelCode, int $offset, int $limit): \Generator
    {
        error;
        yield from [];
    }

    /**
     * İlgili kanalın abone olduğu tüm kanalları oturum açan kullanıcıya göre sayfalama yaparak getirir.
     * @param string $channelCode
     * @param int $offset
     * @param int $limit
     * @param UserAuth $auth
     * @return \Generator<int, Channel>
     */
    private function getPaginatedSubscribedChannelsByChannelCodeWithAuth(string $channelCode, int $offset, int $limit, UserAuth $auth): \Generator
    {
        error;
        return $this->getPaginatedSubscribedChannelsByChannelCodeWithNoAuth($channelCode, $offset, $limit);
    }

    /**
     * İlgili kanalın abone olduğu kanallara ait herkese açık tüm video sayısını döner.
     * @param string $channelCode
     * @return int
     */
    public function getCountPublicContentBySubscriberCode(string $channelCode): int
    {
        $sql = "
            SELECT COUNT(*)
            FROM vw_all_media vam
            WHERE vam.channel_code IN (
                SELECT subscribed_code
                FROM vw_subscription
                WHERE subscriber_code = :channelCode
            )
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    /**
     * İlgili kanalın abone olduğu kanallara ait herkese açık tüm videoları sayfalama yaparak getirir.
     * @param string    $channelCode
     * @param int       $offset
     * @param int       $limit
     * @return \Generator<int, Media>
     */
    public function getPaginatedPublicContentBySubscriberCode(string $channelCode, int $offset, int $limit): \Generator
    {
        $sql = "
            SELECT vam.*
            FROM vw_all_media vam
            WHERE vam.channel_code IN (
                SELECT subscribed_code
                FROM vw_subscription
                WHERE subscriber_code = :channelCode
            )
            ORDER BY vam.date DESC
            LIMIT :limit OFFSET :offset
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':channelCode', $channelCode);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Media::class);
        while ($row = $stmt->fetch()) {
            yield $row;
        }
    }
}
