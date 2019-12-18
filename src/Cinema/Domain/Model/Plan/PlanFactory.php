<?php

declare(strict_types=1);

namespace Cinema\Domain\Model\Plan;

use Cinema\Domain\Shared\Specification\AndSpecification;
use Cinema\Domain\Shared\Specification\NotSpecification;
use Cinema\Domain\Model\Plan\Specification\CinemaCitizenSpecification;
use Cinema\Domain\Model\Plan\Specification\CinemaCitizenSeniorSpecification;
use Cinema\Domain\Model\Plan\Specification\HolidaySpecification;
use Cinema\Domain\Model\Plan\Specification\KidsSpecification;
use Cinema\Domain\Model\Plan\Specification\LateShowSpecification;
use Cinema\Domain\Model\Plan\Specification\MovieDaySpecification;
use Cinema\Domain\Model\Plan\Specification\NonMembershipSpecification;
use Cinema\Domain\Model\Plan\Specification\SeniorSpecification;
use Cinema\Domain\Model\Plan\Specification\WeekdaySpecification;

class PlanFactory
{
    /**
     * @return PlanCollection
     */
    public function createRegularPlanCollection(): PlanCollection
    {
        $cinemaCitizen = [
            $this->createMovieDayCinemaCitizenPlan(),
            $this->createWeekdayCinemaCitizenPlan(),
            $this->createWeekdayLateShowCinemaCitizenPlan(),
            $this->createHolidayCinemaCitizenPlan(),
            $this->createHolidayLateShowCinemaCitizenPlan(),
        ];

        $cinemaCitizenSenior = [
            $this->createMovieDayCinemaCitizenSeniorPlan(),
            $this->createWeekdayCinemaCitizenSeniorPlan(),
            $this->createWeekdayLateShowCinemaCitizenSeniorPlan(),
            $this->createHolidayCinemaCitizenSeniorPlan(),
            $this->createHolidayLateShowCinemaCitizenSeniorPlan(),
        ];

        $general = [
            $this->createMovieDayGeneralPlan(),
            $this->createWeekdayGeneralPlan(),
            $this->createWeekdayLateShowGeneralPlan(),
            $this->createHolidayGeneralPlan(),
            $this->createHolidayLateShowGeneralPlan(),
        ];

        $senior = [
            $this->createMovieDaySeniorPlan(),
            $this->createWeekdaySeniorPlan(),
            $this->createWeekdayLateShowSeniorPlan(),
            $this->createHolidaySeniorPlan(),
            $this->createHolidayLateShowSeniorPlan(),
        ];

        $kids = [
            $this->createMovieDayKidsPlan(),
            $this->createWeekdayKidsPlan(),
            $this->createWeekdayLateShowKidsPlan(),
            $this->createHolidayKidsPlan(),
            $this->createHolidayLateShowKidsPlan(),
        ];

        $plans = array_merge(
            $cinemaCitizen,
            $cinemaCitizenSenior,
            $general,
            $senior,
            $kids
        );

        return new PlanCollection(...$plans);
    }

    /**
     * @return PlanCollection
     */
    public function createDiscountPlanCollection(): PlanCollection
    {
        $universityStudent = [
            $this->createMovieDayUniversityStudentPlan(),
            $this->createWeekdayUniversityStudentPlan(),
            $this->createWeekdayLateShowUniversityStudentPlan(),
            $this->createHolidayUniversityStudentPlan(),
            $this->createHolidayLateShowUniversityStudentPlan(),
        ];

        $highschoolStudent = [
            $this->createMovieDayHighschoolStudentPlan(),
            $this->createWeekdayHighschoolStudentPlan(),
            $this->createWeekdayLateShowHighschoolStudentPlan(),
            $this->createHolidayHighschoolStudentPlan(),
            $this->createHolidayLateShowHighschoolStudentPlan(),
        ];
        
        $personWithDisabilities = [
            $this->createMovieDayPersonWithDisabilitiesPlan(),
            $this->createWeekdayPersonWithDisabilitiesPlan(),
            $this->createWeekdayLateShowPersonWithDisabilitiesPlan(),
            $this->createHolidayPersonWithDisabilitiesPlan(),
            $this->createHolidayLateShowPersonWithDisabilitiesPlan(),
        ];

        $youthWithDisabilities = [
            $this->createMovieDayYouthWithDisabilitiesPlan(),
            $this->createWeekdayYouthWithDisabilitiesPlan(),
            $this->createWeekdayLateShowYouthWithDisabilitiesPlan(),
            $this->createHolidayYouthWithDisabilitiesPlan(),
            $this->createHolidayLateShowYouthWithDisabilitiesPlan(),
        ];

        $plans = array_merge(
            $universityStudent,
            $highschoolStudent,
            $personWithDisabilities,
            $youthWithDisabilities
        );

        return new PlanCollection(...$plans);
    }

    /**
     * @return Plan
     */
    public function createMovieDayCinemaCitizenPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン',
            new Price(1100),
            new AndSpecification(
                new MovieDaySpecification(),
                new CinemaCitizenSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayCinemaCitizenPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new CinemaCitizenSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowCinemaCitizenPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new CinemaCitizenSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayCinemaCitizenPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン',
            new Price(1300),
            new AndSpecification(
                new HolidaySpecification(),
                new CinemaCitizenSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowCinemaCitizenPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン',
            new Price(1000),
            new AndSpecification(
                new HolidaySpecification(),
                new CinemaCitizenSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createMovieDayCinemaCitizenSeniorPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン（60才以上）',
            new Price(1100),
            new AndSpecification(
                new MovieDaySpecification(),
                new CinemaCitizenSeniorSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayCinemaCitizenSeniorPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン（60才以上）',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new CinemaCitizenSeniorSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowCinemaCitizenSeniorPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン（60才以上）',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new CinemaCitizenSeniorSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayCinemaCitizenSeniorPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン（60才以上）',
            new Price(1300),
            new AndSpecification(
                new HolidaySpecification(),
                new CinemaCitizenSeniorSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowCinemaCitizenSeniorPlan(): Plan
    {
        return new MembershipPlan(
            'シネマシティズン（60才以上）',
            new Price(1000),
            new AndSpecification(
                new HolidaySpecification(),
                new CinemaCitizenSeniorSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createMovieDayGeneralPlan(): Plan
    {
        return new Plan(
            '一般',
            new Price(1800),
            new AndSpecification(
                new MovieDaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new SeniorSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayGeneralPlan(): Plan
    {
        return new Plan(
            '一般',
            new Price(1800),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new SeniorSpecification()),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowGeneralPlan(): Plan
    {
        return new Plan(
            '一般',
            new Price(1300),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new SeniorSpecification()),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayGeneralPlan(): Plan
    {
        return new Plan(
            '一般',
            new Price(1800),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new SeniorSpecification()),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowGeneralPlan(): Plan
    {
        return new Plan(
            '一般',
            new Price(1300),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new SeniorSpecification()),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createMovieDaySeniorPlan(): Plan
    {
        return new Plan(
            'シニア（70才以上）',
            new Price(1100),
            new AndSpecification(
                new MovieDaySpecification(),
                new NonMembershipSpecification(),
                new SeniorSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdaySeniorPlan(): Plan
    {
        return new Plan(
            'シニア（70才以上）',
            new Price(1100),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new SeniorSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowSeniorPlan(): Plan
    {
        return new Plan(
            'シニア（70才以上）',
            new Price(1100),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new SeniorSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidaySeniorPlan(): Plan
    {
        return new Plan(
            'シニア（70才以上）',
            new Price(1100),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new SeniorSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowSeniorPlan(): Plan
    {
        return new Plan(
            'シニア（70才以上）',
            new Price(1100),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new SeniorSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createMovieDayKidsPlan(): Plan
    {
        return new Plan(
            '幼児（3才以上）・小学生',
            new Price(1000),
            new AndSpecification(
                new MovieDaySpecification(),
                new NonMembershipSpecification(),
                new KidsSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayKidsPlan(): Plan
    {
        return new Plan(
            '幼児（3才以上）・小学生',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new KidsSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowKidsPlan(): Plan
    {
        return new Plan(
            '幼児（3才以上）・小学生',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new KidsSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayKidsPlan(): Plan
    {
        return new Plan(
            '幼児（3才以上）・小学生',
            new Price(1000),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new KidsSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowKidsPlan(): Plan
    {
        return new Plan(
            '幼児（3才以上）・小学生',
            new Price(1000),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new KidsSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createMovieDayUniversityStudentPlan(): Plan
    {
        return new Plan(
            '学生（大・専）',
            new Price(1100),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayUniversityStudentPlan(): Plan
    {
        return new Plan(
            '学生（大・専）',
            new Price(1500),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowUniversityStudentPlan(): Plan
    {
        return new Plan(
            '学生（大・専）',
            new Price(1300),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayUniversityStudentPlan(): Plan
    {
        return new Plan(
            '学生（大・専）',
            new Price(1500),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowUniversityStudentPlan(): Plan
    {
        return new Plan(
            '学生（大・専）',
            new Price(1300),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createMovieDayHighschoolStudentPlan(): Plan
    {
        return new Plan(
            '中・高校生',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayHighschoolStudentPlan(): Plan
    {
        return new Plan(
            '中・高校生',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowHighschoolStudentPlan(): Plan
    {
        return new Plan(
            '中・高校生',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayHighschoolStudentPlan(): Plan
    {
        return new Plan(
            '中・高校生',
            new Price(1000),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowHighschoolStudentPlan(): Plan
    {
        return new Plan(
            '中・高校生',
            new Price(1000),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createMovieDayPersonWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（学生以上）',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayPersonWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（学生以上）',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowPersonWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（学生以上）',
            new Price(1000),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayPersonWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（学生以上）',
            new Price(1000),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowPersonWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（学生以上）',
            new Price(1000),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createMovieDayYouthWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（高校以下）',
            new Price(900),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayYouthWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（高校以下）',
            new Price(900),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createWeekdayLateShowYouthWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（高校以下）',
            new Price(900),
            new AndSpecification(
                new WeekdaySpecification(),
                new NonMembershipSpecification(),
                new LateShowSpecification()
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayYouthWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（高校以下）',
            new Price(900),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new NotSpecification(new LateShowSpecification())
            )
        );
    }

    /**
     * @return Plan
     */
    public function createHolidayLateShowYouthWithDisabilitiesPlan(): Plan
    {
        return new Plan(
            '障がい者（高校以下）',
            new Price(900),
            new AndSpecification(
                new HolidaySpecification(),
                new NonMembershipSpecification(),
                new LateShowSpecification()
            )
        );
    }
}
