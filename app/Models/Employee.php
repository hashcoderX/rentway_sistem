<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

   
    

    protected $fillable = [
        'fullName',
        'dateOfBirth',
        'gender',
        'nationality',
        'maritalStatus',
        'socialSecurityNumber',
        'photo',
        'address',
        'phoneNumber',
        'email',
        'employeeID',
        'jobTitle',
        'department',
        'employmentStatus',
        'startDate',
        'endDate',
        'manager',
        'salary',
        'employmentType',
        'workSchedule',
        'employmentHistory',
        'highestEducation',
        'degree',
        'institution',
        'fieldOfStudy',
        'graduationDate',
        'emergencyContactName',
        'emergencyContactRelationship',
        'emergencyContactPhone',
        'emergencyContactAddress',
        'bankAccount',
        'taxInformation',
        'healthInsurance',
        'retirementPlan',
        'otherBenefits',
        'performanceReviews',
        'trainingCourses',
        'skillsAssessment',
        'branch',
        'emp_file_no'
    ];

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'employeeid', 'id');
    }
}
