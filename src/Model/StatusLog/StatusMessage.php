<?php

namespace MayMeow\Omglol\Model\StatusLog;

class StatusMessage
{
    /**
     * Undocumented function
     *
     * @param string $content
     * @param string|null $emoji
     * @param string|null $external_url
     * @param boolean $skip_mastodon_post
     */
    public function __construct(
        private string $content,
        private ?string $emoji = null,
        private ?string $external_url= null,
        private bool $skip_mastodon_post = false
    )
    {
        $this->emoji = $emoji;
        $this->content = $content;
        $this->external_url = $external_url;
        $this->skip_mastodon_post = $skip_mastodon_post;
    }

    public function isMastodonPostSkipped(): bool
    {
        return $this->skip_mastodon_post;
    }

    public function getMessageData(bool $isJsonEncoded = true): string|array
    {
        $data = [];

        foreach (get_object_vars($this) as $k => $v) {
            if (is_null($v)) continue;

            $data[$k] = $v;
        }

        if ($isJsonEncoded) return json_encode($data);

        return $data;
    }
}