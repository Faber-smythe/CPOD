  <?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogRepository")
 * @Vich\Uploadable
 * @UniqueEntity("title")
 */
class Log
{

    const TOPIC = [
        'full_name' => [
            0 => 'Billets de voyage',
            1 => 'Notes de développement'
        ],
        'slug' => [
            0 => 'travel',
            1 => 'dev'
        ]
    ];
    const POSITION = [
        0 => 'Début',
        1 => 'Milieu',
        2 => 'Fin'
    ];


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * [private description]
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * [private description]
     * @var null|File
     * @Vich\UploadableField(mapping="log_image", fileNameProperty="filename")
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 50
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    public $topic;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $picture_position;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content2;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
    * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alt;


    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getTopic(): ?int
    {
        return $this->topic;
    }

    public function setTopic(int $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPicturePosition(): ?int
    {
        return $this->picture_position;
    }

    public function setPicturePosition(?int $picture_position): self
    {
        $this->picture_position = $picture_position;

        return $this;
    }

    public function getContent2(): ?string
    {
        return $this->content2;
    }

    public function setContent2(?string $content2): self
    {
        $this->content2 = $content2;

        return $this;
    }

    /**
     * [getFilename description]
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * [setFilename description]
     * @param  null|string $filename [description]
     * @return Log
     */
    public function setFilename(?string $filename): Log
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * [getImageFile description]
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * [setImageFile description]
     * @param  null|File $imageFile [description]
     * @return Log
     */
    public function setImageFile(?File $imageFile): Log
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }
}
