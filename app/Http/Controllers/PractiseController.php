<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PractiseController extends PortalBaseController
{
    private $_page_numbers = 10;

    private function queryList(/* Parameters */){
        $questions = DB::table('practises')->paginate($this->_page_numbers);
        return $questions;
    }

    private function querySpeakingQuestion($subclass){
        $result = array(
            'ID' => '1',
            'Title' => 'THIS SHOULD BE A TITLE',
            'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
            'Tags' => [
                'High Frequency' => 'label label-danger',
                'Easy' => 'label label-warning',
                'Completed' => 'label label-success',
            ],
            'Image' => [
                'Src' => '/temp/DI.png',
                'Format' => 'image/png',
            ],
            'Audio' => [
                'Src' => '/temp/repeat_sentence_sample.wav',
                'Format' => 'audio/wav',
            ],
            'Transcript' => 'Columbia is the bla bla bla',
            'Keywords' => [
                'severe', 'lorries', 'dependent', 'thousand'
            ],
            'Keywords_alt' => [
                'elementum', 'Pellentesque', 'fermentum', 'vulputate'
            ],
            'Comments' => [
                "Lorem ipsum dolor sit amet, consectetur adipiscing
                elit. Nam at eros a nisi ultrices pulvinar. Suspendisse
                neque neque, vehicula in tortor quis, viverra posuere
                arcu.
                Praesent eu pellentesque eros. ",
                "Interdum et malesuada fames ac ante ipsum primis in
                faucibus.",
                "Donec maximus massa eget nunc facilisis, id
                pulvinar
                libero cursus. Duis sapien quam, luctus quis
                laoreet
                ut, luctus
                vel enim. Nullam venenatis bibendum nisl, pulvinar
                mattis ligula laoreet sed.",
                "Donec vel quam metus. Phasellus euismod quam a
                massa
                luctus, non egestas eros iaculis. Morbi vitae metus
                leo. Curabitur egestas molestie tellus. Donec
                eleifend
                sollicitudin
                sem vel
                consectetur. Duis non dolor ut nisi egestas sodales
                in
                a enim.",
                "Suspendisse fringilla malesuada fermentum. Sed
                elementum mollis elit. Duis porttitor lacus turpis,
                nec
                porta ligula rhoncus
                id. Pellentesque venenatis nisi purus.",
                "Duis fringilla vehicula mi, vel suscipit sem
                vulputate
                nec."
            ]
        );

        return json_encode($result);
    }

    private function queryListeningQuestion($subclass){
        switch ($subclass) {
            case 'l-hcs':
            case 'l-mcma':
            case 'l-mcsa':
            case 'l-smw':
                $result = array(
                    'ID' => '1',
                    'Title' => 'THIS SHOULD BE A TITLE',
                    'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
                    'Content' => 'TEST CONTENT',
                    'Tags' => ['High Frequency', 'Easy', 'Completed'],
                    'Audio' => [
                        'Src' => '/temp/Rowan_Atkinson_BBC_Radio4_Front_Row_8_Jan_2012.ogg',
                        'Format' => 'audio/ogg',
                    ],
                    'Question' => 'THIS SHOULD BE A QUESTION',
                    'Options' => [
                        'Option A',
                        'Option B',
                        'Option C',
                        'Option D'
                    ],
                    'Flags' => ['Redo', 'Dictionary'],
                    'Transcript' => 'Generally speaking the things that make me laugh, a,and which ive participated in and I find it extremely difficult. Placing assured be if removed it besides on. Far shed each high read are men over day. Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had now those ought set often which. Or snug dull he show more true wish. No at many deny away miss evil. On in so indeed spirit anmother.Amounted old strictly butmarianne admitted. People former is remove remain as.',
                    'Answer' => 'C',
                    'Explaination' => 'Left till here away at to whom past. Feelings laughing at no wondered repeated provided finished. It acceptance thoroughly my advantages everything as. Are projecting inquietude affronting preference saw who. Marry of am do avoid ample as. Old disposal followed she ignorant desirous two has. Called played entire roused though for one too. He into walk roof made tall cold he. Feelings way likewise addition wandered contempt bed indulged.'
                );
                break;
            case 'l-fib':
                $result = array(
                    'ID' => 1,
                    'Title' => 'THIS SHOULD BE A TITLE',
                    'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
                    'Tags' => [
                        'High Frequency' => 'label label-danger',
                        'Easy' => 'label label-warning',
                        'Completed' => 'label label-success',
                    ],
                    'Audio' => [
                        'Src' => '/temp/repeat_sentence_sample.wav',
                        'Format' => 'audio/wav'
                    ],
                    'Content' => "
                    <p>I'd recommend that you all try to get hold of English in the Southern Hemisphere by
                    Nolan and Watts, as this provides an excellent
                    <input type=\"text\" />
                    of the topics that we're going to be covering in this module.It's really our
                    <input type=\"text\" />
                    text. It has particularly strong sections on the history of English in Australia
                    and New Zealand, examining in some depth how the language has
                    <input type=\"text\" />
                    in these countries. The sections on phonology and on vocabulary will be
                    <input type=\"text\" />
                    when you're doing the written assignment, which I'm going to be telling you about
                    in a moment once I've given you the
                    <input type=\"text\" />
                    of a couple of other essential references.
                    </p>
                    ",
                    'Options' => [
                        'Overview', 'Primary', 'Developed', 'Invaluable', 'Details'
                    ],
                    'Answers' => [
                        'Answer1', 'Answer2', 'Answer3', 'Answer4', 'Answer5'
                    ],
                );
                break;
            case 'l-hiw':
                $result = array(
                    'ID' => 1,
                    'Title' => 'THIS SHOULD BE A TITLE',
                    'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
                    'Tags' => [
                        'High Frequency' => 'label label-danger',
                        'Easy' => 'label label-warning',
                        'Completed' => 'label label-success',
                        'Content' => 'label label-primary',
                        'Comprehensive' => 'label label-info'
                    ],
                    'Audio' => [
                        'Src' => '/temp/repeat_sentence_sample.wav',
                        'Format' => 'audio/wav'
                    ],
                );
                break;
            case 'l-sst':
            case 'l-wfd':
                $result = array(
                    'ID' => 1,
                    'Title' => 'THIS SHOULD BE A TITLE',
                    'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
                    'Tags' => [
                        'High Frequency' => 'label label-danger',
                        'Hard' => 'label label-warning',
                        'Completed' => 'label label-success',
                    ],
                    'Audio' => [
                        'Src' => '/temp/Rowan_Atkinson_BBC_Radio4_Front_Row_8_Jan_2012.ogg',
                        'Format' => 'audio/ogg',
                    ],
                    'Answer' => "The lecture describes how rainbows form. This happens when white light from
                    the sun comes direct to earth and intercepts rainfall. A single drop of
                    that rain transmits seven colors of white light, which are: violet, indigo,
                    blue, green, yellow, orange, and red. This happens at a certain angle at a
                    certain time.",
                    'Transcript' => "When sunrays and raindrops criss-cross in a certain pattern, rainbows are
                    formed. After sunrays enter the raindrops the sunbeams separate into the
                    colors which we see in a rainbow. Sunrays are not made up of a single
                    color, rather they are made up of many colors that we aren't able to see.
                    The white light reaches the earth's surface, then when it comes into
                    contact with raindrops in a specific manner, or let us say a certain angle,
                    it separates into 7 colors: violet, indigo, blue, green, yellow, orange,
                    and red. Every color is at a different angle in the rainbow. Actually, when
                    the white light enters the raindrop every color slows down at a different
                    speed. The same light again leaves the raindrop at different angles, making
                    it look like stripes of different colors."
                );
                break;
            default:
                # code...
                break;
        }
        
        return json_encode($result);
    }

    private function queryReadingQuestion($subclass){
        $result['read_aloud'] = array(
            'ID' => 1,
            'Title' => 'THIS SHOULD BE A TITLE',
            'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
            'Tags' => [
                'High Frequency' => 'label label-danger',
                'Hard' => 'label label-warning',
                'Completed' => 'label label-success',
            ],
            'Audio' => [
                'Src' => '/temp/Rowan_Atkinson_BBC_Radio4_Front_Row_8_Jan_2012.ogg',
                'Format' => 'audio/ogg',
            ],
            'Content' => "Domestication is an evolutionary, rather than a political, development. It is certainly not a regime humans imposed on animals some 10,000 years ago. Rather, domestication happened when a small handful of especially opportunistic species discovered through Darwinian trial and error that they were more likely to survive and prosper in an alliance with humans than on their own. ",
            
        );

        $result['r-fib'] = array(
            'ID' => 1,
            'Title' => 'THIS SHOULD BE A TITLE',
            'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
            'Tags' => [
                'High Frequency' => 'label label-danger',
                'Hard' => 'label label-warning',
                'Completed' => 'label label-success',
            ],
            'Image' => [
                '/temp/pic/s1.png',
                '/temp/pic/s2.png',
                '/temp/pic/s3.png',
                '/temp/pic/s4.png',
                '/temp/pic/s5.png',
            ],
            'Content' => "
            <p>I'd recommend that you all try to get hold of English in the Southern<span id=\"s1\">
            Hemisphere </span>by Nolan and Watts, as this provides an excellent
            <input type=\"text\" id=\"dragTarget\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" />
            of the topics that we're going to be covering in this<span id=\"s2\"> module</span>.It's really our
            <input type=\"text\" id=\"dragTarget1\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" />
            text. It has particularly <span id=\"s3\">strong sections</span> on the history of
            English in Australia and New Zealand, examining in some depth how the language has
            <input type=\"text\" id=\"dragTarget2\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" />
            in these countries. The sections on phonology and on vocabulary will be
            <input type=\"text\" id=\"dragTarget3\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" />
            when you're doing the written assignment, which I'm going to be telling you about
            in a moment once I've given you the
            <input type=\"text\" id=\"dragTarget4\" ondrop=\"drop(event)\" ondragover=\"allowDrop(event)\" />
            of a couple of other essential references.
            </p>
            ",
            'Answers' => [
                'Answer1','Answer2','Answer3','Answer4','Answer5'
            ],
            'Hints' => [
                ['Helps to Improve', 'Simple present Tense', 'None of the other options are proper English verb tenses.'],
                ['Levels', 'Quantitative Noun', 'Poverty is customarily measured in "levels"'],
                ['Since', 'Preposition + Past Participle', '"since"and"in" are acceptable prepositions for a specific year."risen" earlier in the sentence indicates a past tense.'],
                ['Means', 'Preposition + Vocabulary', '"factor"is normally paired with the preposition"in"."Factor of"is only userd to refer to numbers.
                "means"has a similar meaning to "method".<br />
                "aspect"refers to the characteristics or feature or an object.'],
                ['Figure', 'Pronoun + Quantitative', '"This" refers to "40% of global eletricity" in the previous sentence.<br />
                "40% of global eletricity" can be referred to generally as a "figure"but it is not a
                sum(adding multiple values),volume(quantity) or total(100%).']
            ]
        );
        $result['r-mcma'] = $result['r-mcsa'] = array(
            'ID' => '1',
            'Title' => 'THIS SHOULD BE A TITLE',
            'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
            'Content' => 'TEST CONTENT',
            'Tags' => ['High Frequency', 'Easy', 'Completed'],
            'Content' => 'New the her nor case that lady paid read. Invitation friendship travelling eat everything the out two. Shy you who scarcely expenses debating hastened resolved. Always polite moment on is warmth spirit it to hearts. Downs those still witty an balls so chief so. Moment an little remain no up lively no. Way brought may off our regular country towards adapted cheered. John draw real poor on call my from. May she mrs furnished discourse extremely. Ask doubt noisy shade guest did built her him. Ignorant repeated hastened it do. Consider bachelor he yourself expenses no. Her itself active giving for expect vulgar months. Discovery commanded fat mrs remaining son she principle middleton neglected. Be miss he in post sons held. No tried is defer do money scale rooms.',
            'Question' => 'THIS SHOULD BE A QUESTION',
            'Options' => [
                'Option A',
                'Option B',
                'Option C',
                'Option D'
            ],
            'Flags' => ['Redo', 'Dictionary'],
            'Transcript' => 'Generally speaking the things that make me laugh, a,and which ive participated in and I find it extremely difficult. Placing assured be if removed it besides on. Far shed each high read are men over day. Afraid we praise lively he suffer family estate is. Ample order up in of in ready. Timed blind had now those ought set often which. Or snug dull he show more true wish. No at many deny away miss evil. On in so indeed spirit anmother.Amounted old strictly butmarianne admitted. People former is remove remain as.',
            'Answer' => 'C',
            'Explaination' => 'Left till here away at to whom past. Feelings laughing at no wondered repeated provided finished. It acceptance thoroughly my advantages everything as. Are projecting inquietude affronting preference saw who. Marry of am do avoid ample as. Old disposal followed she ignorant desirous two has. Called played entire roused though for one too. He into walk roof made tall cold he. Feelings way likewise addition wandered contempt bed indulged.'
        );
        $result['r-rp'] = array(
            'ID' => 1,
            'Title' => 'THIS SHOULD BE A TITLE',
            'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
            'Tags' => [
                'High Frequency' => 'label label-danger',
                'Hard' => 'label label-warning',
                'Completed' => 'label label-success',
            ],
            'Options' => [
                'Clearly, a number of factors have contributed to its
                remarkable appearance.',
                'The result is a unique story of land collisions and
                erosions, and of rising and falling water levels.',
                'Experts who have analysed the rock formations say that,
                historically. it goes back nearly two billion years.',
                'Anyone who has ever visited the Grand Canyon will agree
                that it is one of the most incredible Sights in the world.',
                'The geological processes that have taken place since
                then are exposed for everyone to see, not hidden beneath vegetation or a
                fast-flowing water course.'
            ]
        );
        $result['rw-fib'] = array(
            'ID' => 1,
            'Title' => 'THIS SHOULD BE A TITLE',
            'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
            'Tags' => [
                'High Frequency' => 'label label-danger',
                'Hard' => 'label label-warning',
                'Completed' => 'label label-success',
            ],
            'Content' => "
            <p>I'd recommend that you all try to get hold of English in the Southern<span id='s1'> Hemisphere </span>by Nolan and Watts, as this provides an excellent
              <select>
                <option>-select-</option>
                <option>option1</option>
                <option>option2</option>
                <option>option3</option>
              </select>
              of the topics that we're going to be covering in this<span id='s2'> module</span>.It's really our
              <select>
                <option>-select-</option>
                <option>option1</option>
                <option>option2</option>
                <option>option3</option>
              </select>
              text. It has particularly <span id='s3'>strong sections</span> on the history of English in Australia and New Zealand, examining in some depth how the language has
              <select>
                <option>-select-</option>
                <option>option1</option>
                <option>option2</option>
                <option>option3</option>
              </select>
              in these countries. The sections on phonology and on vocabulary will be
              <select>
                <option>-select-</option>
                <option>option1</option>
                <option>option2</option>
                <option>option3</option>
              </select>
              when you're doing the written assignment, which I'm going to be telling you about in a moment once I've given you the
              <select>
                <option>-select-</option>
                <option>option1</option>
                <option>option2</option>
                <option>option3</option>
              </select>
              of a couple of other essential references.
              </p>
            ",
            'Answers' => [
                'Answer1','Answer2','Answer3','Answer4','Answer5'
            ],
            'Hints' => [
                ['Helps to Improve', 'Simple present Tense', 'None of the other options are proper English verb tenses.'],
                ['Levels', 'Quantitative Noun', 'Poverty is customarily measured in "levels"'],
                ['Since', 'Preposition + Past Participle', '"since"and"in" are acceptable prepositions for a specific year."risen" earlier in the sentence indicates a past tense.'],
                ['Means', 'Preposition + Vocabulary', '"factor"is normally paired with the preposition"in"."Factor of"is only userd to refer to numbers.
                "means"has a similar meaning to "method".<br />
                "aspect"refers to the characteristics or feature or an object.'],
                ['Figure', 'Pronoun + Quantitative', '"This" refers to "40% of global eletricity" in the previous sentence.<br />
                "40% of global eletricity" can be referred to generally as a "figure"but it is not a
                sum(adding multiple values),volume(quantity) or total(100%).']
            ]
        );

        return json_encode($result[$subclass]);
    }

    private function queryWritingQuestion($subclass){
        $result = array(
            'ID' => 1,
            'Title' => 'THIS SHOULD BE A TITLE',
            'Subtitle' => 'THIS SHOULD BE A SUBTITLE',
            'Tags' => [
                'High Frequency' => 'label label-danger',
                'Hard' => 'label label-warning',
                'Completed' => 'label label-success',
            ],
            'Content' => '
            <p class="paragraph">
            What makes teaching online unique is that it uses the Internet, especially the World
            Wide Web, as the primary means of communication. Thus, when you teach online, you don’t
            have to be someplace to teach. You don’t have to lug your briefcase full of papers or
            your laptop to a classroom, stand at a lectern, scribble on a chalkboard, or grade
            papers in a stuffy room while your students take a test. You don’t even have to sit in
            your office waiting for students to show up for conferences. You can hold “office
            hours” on weekends or at night after dinner.
            </p>
            <p class="paragraph">
            You can do all this while living in a small town in Wyoming or a big city like Bangkok,
            even if you’re working for a college whose administrative offices are located in
            Florida or Dubai. You can attend an important conference in Hawaii on the same day that
            you teach your class in New Jersey, longing on from your laptop via the local cafe’s
            wireless hot sport or your hotel room’s high-speed network.
            </p>
            <p class="paragraph">
            Online learning offers more freedom for students as well. They can search for courses
            using the Web, scouring their institution or even the world for programs, classes and
            instructors that fit their needs. Having found an appropriate course, they can enrol
            and register, shop for their books, read articles, listen to lectures, submit their
            homework assignments, confer with their instructors, and receive their final grades –
            all online. They can assemble in virtual classrooms, joining other students from
            diverse geographical locales, forging bond and friendships not possible in conventional
            classrooms, which are usually limited to students from a specific geographical area.
            </p>
            ',
            'Answer' => "
            Online teaching provide freedom to both teachers and students as teachers need not to be at a specific place to teach because they use internet as the medium of communication, whereas, students can enroll, register, submit assignments and receive grades- all online. 
            "
        );

        return json_encode($result);
    }

    public function index(Request $request, $category=null){
        $this->broadcastSharedDataToAllViews($request, $category);
        if ($category){
            return view('practise.category');
        } else {
            return view('practise.index');
        }
    }

    public function redirectToQuestion(Request $request, $category, $subclass, $questionID){
        $this->broadcastSharedDataToAllViews($request, $category, $subclass);

        switch ($category) {
            case 'listening':
                $Question_Object = $this->queryListeningQuestion($subclass);
                break;
            case 'speaking':
                $Question_Object = $this->querySpeakingQuestion($subclass);
                break;
            case 'reading':
                $Question_Object = $this->queryReadingQuestion($subclass);
                break;
            case 'writing':
                $Question_Object = $this->queryWritingQuestion($subclass);
                break;
            default:
                echo 'ERROR';
                break;
        }
        
        //var_dump($Question_Object);
        return view('practise.'.$subclass, compact('Question_Object'));
    }

    public function redirectToList(Request $request, $category, $subclass){
        $this->broadcastSharedDataToAllViews($request, $category, $subclass);
        $Questions_List_Object = $this->queryList(/* Parameters */);
        return view('practise.question_list')->with('Questions_List_Object', $Questions_List_Object);
    }
}