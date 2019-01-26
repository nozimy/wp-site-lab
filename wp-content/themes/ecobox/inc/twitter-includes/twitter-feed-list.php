<?php
	$tweets = getTweets(1);//change number up to 20 for number of tweets
	
	if(!isset($tweets['error'])) {
		if(is_array($tweets)){

			// to use with intents
			echo '<script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

			echo '<div class="twitter-feed">';

			foreach($tweets as $tweet){

				echo '<div class="twitter-article-col">';
				echo '<div class="twitter-article">';

				if($tweet['text']){
				  $the_tweet = $tweet['text'];

				echo ' <a class="btn btn-primary btn-sm btn-twitter" href="//twitter.com/'.$tweet['user']['screen_name'].'" target="_blank"><i class="fa fa-twitter"></i>'.__( 'Follow', 'ecobox' ).'</a>';

				echo '<div class="twitter-pic"><a href="//twitter.com/'.$tweet['user']['screen_name'].'" target="_blank"><img src="'.$tweet['user']['profile_image_url_https'].'" width="50" height="50" alt="twitter icon" /></a></div>';

				echo '<div class="twitter-meta"><span class="tweetprofilelink"><span class="twitter-user-name">'.$tweet['user']['name'].'</span> <a href="//twitter.com/'.$tweet['user']['screen_name'].'" target="_blank">@'.$tweet['user']['screen_name'].'</a></span></div>';

				  /*
				  Twitter Developer Display Requirements
				  //dev.twitter.com/terms/display-requirements

				  2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
				    i. User_mentions must link to the mentioned user's profile.
				   ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				  iii. Links in Tweet text must be displayed using the display_url
				       field in the URL entities API response, and link to the original t.co url field.
				  */

				  // i. User_mentions must link to the mentioned user's profile.
				  if(is_array($tweet['entities']['user_mentions'])){
				      foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
				          $the_tweet = preg_replace(
				              '/@'.$user_mention['screen_name'].'/i',
				              '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
				              $the_tweet);
				      }
				  }

				  // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				  if(is_array($tweet['entities']['hashtags'])){
				      foreach($tweet['entities']['hashtags'] as $key => $hashtag){
				          $the_tweet = preg_replace(
				              '/#'.$hashtag['text'].'/i',
				              '<a href="//twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
				              $the_tweet);
				      }
				  }

				  // iii. Links in Tweet text must be displayed using the display_url
				  //      field in the URL entities API response, and link to the original t.co url field.
				  if(is_array($tweet['entities']['urls'])){
				      foreach($tweet['entities']['urls'] as $key => $link){
				          $the_tweet = preg_replace(
				              '`'.$link['url'].'`',
				              '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
				              $the_tweet);
				      }
				  }

				  echo '<div class="twitter-text">';
				  echo $the_tweet;
				  echo '</div>';


				  // 3. Tweet Actions
				  //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
				  //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
				  // get the sprite or images from twitter's developers resource and update your stylesheet

				  echo '
				  <div class="twitter-actions">
				      <div class="intent intent-reply">
				      	<a class="reply" href="//twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="fa fa-reply"></i><span class="txt-wrap">'.__( 'Reply', 'ecobox' ).'</span></a>
				      </div>
				      <div class="intent intent-retweet">
				      	<a class="retweet" href="//twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="fa fa-retweet"></i><span class="txt-wrap">'.__( 'Retweet', 'ecobox' ).'</span></a>
				      </div>
				      <div class="intent intent-fave">
				      	<a class="favorite" href="//twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="fa fa-star"></i><span class="txt-wrap">'.__( 'Favorite', 'ecobox' ).'</span></a>
				      </div>
				  </div>';


				  // 4. Tweet Timestamp
				  //    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
				  // 5. Tweet Permalink
				  //    The Tweet timestamp must always be linked to the Tweet permalink.
				  echo '
			      <div class="twitter-date"><span class="tweet-time"><a class="timesince" href="//twitter.com/'.$tweet['user']['screen_name'].'/status/'.$tweet['id_str'].'" target="_blank">    '.ecobox_twitter_time(date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours'))).'</a></span></div>';// -8 GMT for Pacific Standard Time
				} else {
				  echo '
				  <br />
				  <a href="http://twitter.com/'.$tweet['user']['screen_name'].'" target="_blank">Click here to read '.$tweet['user']['screen_name'].'\'s Twitter feed</a>';
				}

			   echo '</div>';
			   echo '</div>';

			}
		echo '</div>';
		}
	}
 ?>