<?php
/*
 / Facade Pattern
 / We need to consider the use of the facade pattern in those cases that
 / the code that we want to use consists of too many classes and methods,
 / and all we want is a simple interface, preferably one method, that can do all the job for us.
 */

class FacebookShare {
    public function shareOnFacebook(string $post)
    {
        echo "Shared {$post} with on Facebook\n";
    }
}

class TwitterShare {

    public function shareOnTwitter(string $post, int $postId)
    {
        echo "Shared {$post} with post id of {$postId} on Twitter\n";
    }
}

class TelegramShare {

    public function shareOnTelegram(string $post)
    {
        echo "Shared {$post} with on Telegram\n";
    }

}

class ShareFacade {

    private $facebookShare;
    private $twitterShare;
    private $telegramShare;

    public function __construct()
    {
        $this->facebookShare = new FacebookShare();
        $this->twitterShare = new TwitterShare();
        $this->telegramShare = new TelegramShare();
    }

    public function share(string $post, int $postId)
    {
        $this->facebookShare->shareOnFacebook($post);
        $this->twitterShare->shareOnTwitter($post, $postId);
        $this->telegramShare->shareOnTelegram($post);
    }
}

(new ShareFacade())->share('Post 1', '1');