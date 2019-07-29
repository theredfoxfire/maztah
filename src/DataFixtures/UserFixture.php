<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Question;
use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $userManager = $manager;
        $questionManager = $manager;
        $answerManager = $manager;
      for ($i = 0; $i < 10; $i++) {
          $user = new User();
          $user->setFullname('User '.$i);
          $user->setEmail('user@mail.com'.$i);
          $user->setPassword('password');
          $user->setCreatedAt();
          $userManager->persist($user);
          for ($j = 0; $j < 5; $j++) {
              $question = new Question();
              $question->setTitle('question'.$i.$j);
              $question->setDescription('Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
  laboris sunt venison, et laborum dolore minim non meatball.
  Shankle eu flank aliqua shoulder,
  capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
  picanha shank et filet mignon pork belly ut ullamco.');
              $question->setCreatedAt();
              $question->setUser($user);
              $questionManager->persist($question);
              for ($k = 0; $k < 5; $k++) {
                    $answer = new Answer();
                    $answer->setQuestion($question);
                    $answer->setDescription('Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
      laboris sunt venison, et laborum dolore minim non meatball');
                    $answer->setCreatedAt();
                    $answer->setUser($user);
                    $answerManager->persist($answer);
              }
           }
      }
      $userManager->flush();
      $questionManager->flush();
      $answerManager->flush();
    }
}
