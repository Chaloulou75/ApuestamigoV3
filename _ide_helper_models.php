<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Championnat
 *
 * @property int $id
 * @property string $name
 * @property int $finished
 * @property string $logo
 * @property string $logourl
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Equipe[] $equipes
 * @property-read int|null $equipes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Game[] $games
 * @property-read int|null $games_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DateJournee[] $journees
 * @property-read int|null $journees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ligue[] $ligues
 * @property-read int|null $ligues_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Match[] $matchs
 * @property-read int|null $matchs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat whereFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat whereLogourl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Championnat whereUpdatedAt($value)
 */
	class Championnat extends \Eloquent {}
}

namespace App{
/**
 * App\DateJournee
 *
 * @property int $id
 * @property int $championnat_id
 * @property string|null $namejournee
 * @property string|null $timejournee
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Championnat $championnat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Game[] $games
 * @property-read int|null $games_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee whereChampionnatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee whereNamejournee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee whereTimejournee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DateJournee whereUpdatedAt($value)
 */
	class DateJournee extends \Eloquent {}
}

namespace App{
/**
 * App\Equipe
 *
 * @property int $id
 * @property int $championnat_id
 * @property string $name
 * @property string $logo
 * @property string|null $logourl
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Championnat $championnat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Game[] $games
 * @property-read int|null $games_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe whereChampionnatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe whereLogourl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Equipe whereUpdatedAt($value)
 */
	class Equipe extends \Eloquent {}
}

namespace App{
/**
 * App\Game
 *
 * @property int $id
 * @property int $championnat_id
 * @property int $equipe1_id
 * @property int $equipe2_id
 * @property int|null $date_journees_id
 * @property string|null $gamedate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Equipe $awayTeam
 * @property-read \App\Championnat $championnat
 * @property-read \App\Equipe $homeTeam
 * @property-read \App\DateJournee|null $journee
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Match[] $matchs
 * @property-read int|null $matchs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereChampionnatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereDateJourneesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereEquipe1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereEquipe2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereGamedate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Game whereUpdatedAt($value)
 */
	class Game extends \Eloquent {}
}

namespace App{
/**
 * App\Ligue
 *
 * @property int $id
 * @property int $championnat_id
 * @property string $name
 * @property int|null $creator_id
 * @property string $token
 * @property int $finished
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Championnat $championnat
 * @property-read \App\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Match[] $matchs
 * @property-read int|null $matchs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue whereChampionnatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue whereFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ligue whereUpdatedAt($value)
 */
	class Ligue extends \Eloquent {}
}

namespace App{
/**
 * App\Match
 *
 * @property int $id
 * @property int $championnat_id
 * @property int|null $date_journees_id
 * @property int $user_id
 * @property int $ligue_id
 * @property int $game_id
 * @property int|null $resultatEq1
 * @property int|null $resultatEq2
 * @property int|null $pointMatch
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Championnat $championnat
 * @property-read \App\Game $games
 * @property-read \App\DateJournee|null $journee
 * @property-read \App\Ligue $ligues
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereChampionnatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereDateJourneesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereLigueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match wherePointMatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereResultatEq1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereResultatEq2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Match whereUserId($value)
 */
	class Match extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property int|null $equipe_id
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $admin
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $trial_ends_at
 * @property-read \App\Equipe|null $equipe
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ligue[] $ligues
 * @property-read int|null $ligues_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Match[] $matchs
 * @property-read int|null $matchs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Cashier\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEquipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

