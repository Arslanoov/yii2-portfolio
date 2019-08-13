<?php

namespace portfolio\entities\Portfolio\Work;

use portfolio\entities\behaviors\MetaBehavior;
use portfolio\entities\Meta;
use portfolio\entities\Portfolio\Category;
use portfolio\entities\Portfolio\queries\WorkQuery;
use portfolio\entities\Portfolio\Skill;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;
use DomainException;

class Work extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public $meta;

    public static function tableName(): string
    {
        return '{{%portfolio_works}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['skillAssignments'],
            ],
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'photo',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticRoot/origin/portfolio/works/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/portfolio/works/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/portfolio/works/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/portfolio/works/[[profile]]_[[id]].[[extension]]',
                'thumbs' => [
                    'view' => ['width' => 261, 'height' => 269],
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 1080, 'height' => 720],
                    'single' => ['width' => 1140, 'height' => 760],
                    'widget' => ['width' => 555, 'height' => 370]
                ],
            ],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function create($categoryId, $date, $link, $slug, $title, $client, Meta $meta): self
    {
        $work = new static();
        $work->category_id = $categoryId;
        $work->date = $date;
        $work->link = $link;
        $work->slug = $slug;
        $work->title = $title;
        $work->client = $client;
        $work->status = self::STATUS_DRAFT;
        $work->meta = $meta;
        return $work;
    }

    public function edit($categoryId, $date, $link, $slug, $title, $client, Meta $meta): void
    {
        $this->category_id = $categoryId;
        $this->date = $date;
        $this->link = $link;
        $this->slug = $slug;
        $this->title = $title;
        $this->client = $client;
        $this->meta = $meta;
    }

    public static function find(): WorkQuery
    {
        return new WorkQuery(static::class);
    }

    public function activate(): void
    {
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft(): void
    {
        $this->status = self::STATUS_DRAFT;
    }

    public function setPhoto(UploadedFile $photo): void
    {
        $this->photo = $photo;
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function assignSkill($id): void
    {
        $assignments = $this->skillAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForSkill($id)) {
                return;
            }
        }
        $assignments[] = SkillAssignments::create($id);
        $this->skillAssignments = $assignments;
    }

    public function revokeSkill($id): void
    {
        $assignments = $this->skillAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForSkill($id)) {
                unset($assignments[$i]);
                $this->skillAssignments = $assignments;
                return;
            }
        }

        throw new DomainException('Назначение не найдено');
    }

    public function revokeSkills(): void
    {
        $this->skillAssignments = [];
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getSkillAssignments(): ActiveQuery
    {
        return $this->hasMany(SkillAssignments::class, ['work_id' => 'id']);
    }

    public function getSkills(): ActiveQuery
    {
        return $this->hasMany(Skill::class, ['id' => 'skill_id'])->via('skillAssignments');
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?? $this->title;
    }

    public function getData(): ActiveQuery
    {
        return $this->hasMany(WorkData::class, ['work_id' => 'id']);
    }
}