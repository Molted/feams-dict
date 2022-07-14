<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Validation\UserRules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
		UserRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $users = [
		'first_name' => [
			'label' => 'First name', 
			'rules' => 'required|min_length[2]|max_length[30]|alpha_space'
		],
		'middle_name' => [
			'label' => 'Middle name',
			'rules' => 'max_length[30]|regex_match[/^$|^[a-zA-Z\s]*$/]',
			'errors' => [
				'regex_match' => 'The Middle Name field may only contain alphabetical characters and spaces.',
			]
		],
		'last_name' => [
			'label' => 'Last Name', 
			'rules' => 'required|min_length[2]|max_length[30]|alpha_space'
		],
		'email' => [
			'label' => 'Email', 
			'rules' => 'required|min_length[5]|max_length[70]|valid_email|is_unique[users.email]',
			'errors' => [
				'is_unique' => 'Email already exists!',	
			]
		],
		'username' => [
			'label' => 'Username', 
			'rules' => 'required|min_length[5]|max_length[30]|is_unique[users.username]|alpha_numeric',
			'errors' => [
				'is_unique' => 'Username already exists!',	
			]
		],
		'password' => [
			'label' => 'Password', 
			'rules' => 'required|regex_match[/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,30}$/]',
			'errors' => [
				'regex_match' => '8-30 characters, One Uppercase, One Number, Special Characters (!@#$%^&*-)',
			]
		],
		'image' => [
			'label' => 'Profile Picture', 
			'rules' => 'uploaded[image]|ext_in[image,png,jpg,jpeg]',
			'errors' => [
				'uploaded' => 'Profile picture is required',
				'ext_in' => 'Profile picture is not an image',
			],
		],
		'contact_number' => [
			'label' => 'Contact Number', 
			'rules' => 'required|min_length[10]|max_length[10]|is_natural',
			'errors' => [
				'max_length' => 'The number of digits are not equal to 10. (e.g. 9123456789)',
				'min_length' => 'The number of digits are not equal to 10. (e.g. 9123456789)',
			],
		],
		'type' => [
			'label' => 'Employee Type',
			'rules' => 'required'
		],
		'payment_method' => [
			'label' => 'Payment Method',
			'rules' => 'required'
		]
	];

	public $roles = [
		'role_name' => [
			'label' => 'Role Name', 
			'rules' => 'required|min_length[3]|max_length[30]|alpha_numeric_space|is_unique[roles.role_name]',
			'errors' => [
				'required' => 'Role name is required',
				'min_length' => 'Role name too short',
				'max_length' => 'Role name exceeds max characters',
				'alpha_numeric_space' => 'Role name only accepts alphanumeric characters',
				'is_unique' => 'Role already exists'
			],
		],
	];

	public $role_perm = [
		'role_id' => [
			'label' => 'Role', 
			'rules' => 'required',
			'errors' => [
				'required' => 'Role is required',
			],
		],
		// 'perm_id' => [
		// 	'label' => 'Permissions', 
		// 	'rules' => 'required',
		// 	'errors' => [
		// 		'required' => 'Permission is required',
		// 	],
		// ],
	];

	public $announcements = [
		'title' => [
			'label' => 'Title', 
			'rules' => 'required|min_length[2]|max_length[50]',
			'errors' => [
				'required' => 'Title field is required',
				'min_length' => 'Title field too short',
				'max_length' => 'Title field reached max character length',
			]
		],
		'description' => [
			'label' => 'Description', 
			'rules' => 'required|min_length[2]',
			'errors' => [
				'required' => 'Description field is required',
				'min_length' => 'Description field too short',
			]
		],
		'image' => [
			'label' => 'Image', 
			'rules' => 'is_image[image]',
			'errors' => [
				'is_image' => 'Uploaded file is not an image',
			]
		],
	];

	public $sliders = [
		'title' => [
			'label' => 'Title', 
			'rules' => 'max_length[999]',
			'errors' => [
				'min_length' => 'Title field too short',
				'max_length' => 'Title field reached max character length',
			]
		],
		'description' => [
			'label' => 'Description', 
			'rules' => 'max_length[999]',
			'errors' => [
				'min_length' => 'Description field too short',
				'max_length' => 'Description field reached max character length',
			]
		],
		'image' => [
			'label' => 'image', 
			'rules' => 'uploaded[image]|is_image[image]',
			'errors' => [
				'uploaded' => 'No image uploaded',
				'is_image' => 'Uploaded file is not an image',
			]
		],
	];

	public $elections = [
		'title' => [
			'label' => 'Election Title', 
			'rules' => 'required|min_length[5]|max_length[255]|alpha_numeric_space',
			'errors' => [
				'required' => 'Election title is required',
				'min_length' => 'Election title too short',
				'max_length' => 'Election title too long',
				'alpha_numeric_space' => 'Election title only accepts letters, numbers and spaces',
			]
		],
		'vote_start' => [
			'label' => 'Start Date', 
			'rules' => 'required|regex_match[/^([0-9]{4})([\-])([0-9]{2})([\-])([0-9]{2})[\ ]'.'([0-9]{2})[\:]([0-9]{2})[\:]([0-9]{2})$/]',
			'errors' => [
				'required' => 'Vote start is required',
				'regex_match' => 'Vote start date is not a valid date',
			]
		],
		'vote_end' => [
			'label' => 'End Date', 
			'rules' => 'required|regex_match[/^([0-9]{4})([\-])([0-9]{2})([\-])([0-9]{2})[\ ]'.'([0-9]{2})[\:]([0-9]{2})[\:]([0-9]{2})$/]',
			'errors' => [
				'required' => 'Vote end is required',
				'regex_match' => 'Vote end date is not a valid date',
			]
		],
		'type' => [
			'label' => 'Election type', 
			'rules' => 'required|in_list[1,2]',
			'errors' => [
				'required' => 'Election type is required',
				'in_list' => 'Error selecting election type',
			]
		],
	];

	public $edit_elec = [
		'title' => [
			'label' => 'Election Title', 
			'rules' => 'required|min_length[5]|max_length[255]|alpha_numeric_space',
			'errors' => [
				'required' => 'Election title is required',
				'min_length' => 'Election title too short',
				'max_length' => 'Election title too long',
				'alpha_numeric_space' => 'Election title only accepts letters, numbers and spaces',
			]
		],
		'vote_start' => [
			'label' => 'Start Date', 
			'rules' => 'required|regex_match[/^([0-9]{4})([\-])([0-9]{2})([\-])([0-9]{2})[\ ]'.'([0-9]{2})[\:]([0-9]{2})[\:]([0-9]{2})$/]',
			'errors' => [
				'required' => 'Vote start is required',
				'regex_match' => 'Vote start date is not a valid date',
			]
		],
		'vote_end' => [
			'label' => 'End Date', 
			'rules' => 'regex_match[/^([0-9]{4})([\-])([0-9]{2})([\-])([0-9]{2})[\ ]'.'([0-9]{2})[\:]([0-9]{2})[\:]([0-9]{2})$/]',
			'errors' => [
				'required' => 'Vote end is required',
				'regex_match' => 'Vote end date is not a valid date',
			]
		],
	];

	public $positions = [
		'election_id' => [
			'label' => 'Election Name', 
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'Election is required',
				'numeric' => 'Error selecting an election',
			],
		],
		'name' => [
			'label' => 'Position Name', 
			'rules' => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
			'errors' => [
				'required' => 'Position name field is required',
				'min_length' => 'Position name field too short',
				'max_length' => 'Position name field exceed limit',
				'alpha_numeric_space' => 'Position name field includes symbols',
			],
		],
		'max_candidate' => [
			'label' => 'Max candidates', 
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'Max number of candidates is required',
				'numeric' => 'Max number is not a number',
			],
		],
	];

	public $candidates = [
		'user_id' => [
			'label' => 'Candidate Name',
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'Please choose a candidate',
				'numeric' => 'Wrong choice, please try again',
			]
		],
		'position_id' => [
			'label' => 'Position',
			'rules' => 'required|numeric',
			'errors' => [
				'required' => 'Please choose a position',
				'numeric' => 'Wrong choice, please try again',
			]
		],
		'photo' => [
			'label' => 'Photo', 
			'rules' => 'is_image[photo]',
			'errors' => [
				'is_image' => 'Uploaded file is not a photo',
			]
		],
		'platform' => [
			'label' => 'Platform', 
			'rules' => 'max_length[999]',
			'errors' => [
				'max_length' => 'Platform field reached max character length',
			]
		],
	];

	public $fileCategory = [
		'name' => [
			'label' => 'Category Name',
			'rules' => 'required|min_length[3]|max_length[100]|alpha_numeric_space',
			'errors' => [
				'required' => 'File category name field is required',
				'min_length' => 'File category name field too short',
				'max_length' => 'File category name field exceed limit',
				'alpha_numeric_space' => 'File category name field includes symbols',
			]
		],
	];

	public $files = [
		'name' => [
			'label' => 'File Name', 
			'rules' => 'required|min_length[5]|max_length[30]|alpha_numeric_space'
		],
		'file' => [
			'label' => 'File',
			'rules' => 'uploaded[file]|max_size[file,20971520]',
			'errors' => [
				'max_size' => 'File size must be less than 20Mb',
			],
		],
	];
	
	public $comment = [
		'comment' => [
			'rules' => 'required|min_length[3]',
			'errors' => [
				'required' => 'Comment is required',
				'min_length' => 'Comment field too short',
				// 'max_length' => 'Comment exceed limit',
			],
		],
	];

  public $editUser = [
	'first_name' => [
		'label' => 'First name', 
		'rules' => 'required|min_length[2]|max_length[30]|alpha_space'
	],
	'middle_name' => [
		'label' => 'Middle name',
		'rules' => 'max_length[30]|regex_match[/^$|^[a-zA-Z\s]*$/]',
		'errors' => [
			'regex_match' => 'The Middle Name field may only contain alphabetical characters and spaces.',
		]
	],
	'last_name' => [
		'label' => 'Last Name', 
		'rules' => 'required|min_length[2]|max_length[30]|alpha_space'
	],
	'email' => [
		'label' => 'Email', 
		'rules' => 'required|min_length[5]|max_length[70]|valid_email',
		'errors' => [
			'is_unique' => 'Email already exists!',	
		]
	],
	'image' => [
		'label' => 'Profile Picture', 
		'rules' => 'ext_in[image,png,jpg,jpeg]',
		'errors' => [
			'ext_in' => 'Profile picture is not an image',
		],
	],
	'contact_number' => [
		'label' => 'Contact Number', 
		'rules' => 'required|min_length[10]|max_length[10]|is_natural',
		'errors' => [
			'max_length' => 'The number of digits are not equal to 10. (e.g. 9123456789)',
			'min_length' => 'The number of digits are not equal to 10. (e.g. 9123456789)',
		],
	],
  ];

  public $constitution = [
    'area' => [
        'label' => 'Area',
        'rules' => 'required',
        'errors' => [
            'required' => 'Constitution area is required',
        ],
    ],
    'content' => [
        'label' => 'Content',
        'rules' => 'required',
        'errors' => [
            'required' => 'Constitution content is required',
        ],
    ],
  ];

  public $electoral_position = [
    'position_name' => [
        'label' => 'Position Name',
        'rules' => 'required|max_length[100]|alpha_numeric_space|is_unique[electoral_positions.position_name]',
        'errors' => [
            'required' => 'Position name is required',
            'max_length' => 'Position name exceed maximum length',
            'alpha_numeric_space' => 'Position name includes symbols',
        ],
    ],
    'max_candidate' => [
        'label' => 'Max no. of Candidate',
        'rules' => 'required',
    ],
  ];

  public $positions2 = [
    'election_id' => [
        'rules' => 'required|integer',
        'errors' => [
            'required' => 'Election is required',
            'integer' => 'Error in selecting election',
        ],
    ],
  ];
  
  public $contributions = [
    'name' => [
        'rules' => 'required|alpha_numeric_space',
        'errors' => [
            'required' => 'Name is required',
            'alpha_numeric_space' => 'Name includes invalid symbols',
        ],
    ],
    'cost' => [
        'rules' => 'required|numeric',
        'errors' => [
            'required' => 'Cost is required',
            'numeric' => 'Cost only includes numbers',
        ],
    ],
  ];

  public $payments = [
    'user_id' => [
        'rules' => 'required|numeric',
        'errors' => [
            'required' => 'Name is required',
            'numeric' => 'Error in selecting user',
        ],
    ],
    'contri_id' => [
        'rules' => 'required|numeric',
        'errors' => [
            'required' => 'Cost is required',
            'numeric' => 'Error in selecting payments',
        ],
    ],
    'amount' => [
        'rules' => 'required|numeric',
        'errors' => [
            'required' => 'Cost is required',
            'numeric' => 'Amount should be in numerical form',
        ],
    ],
    'photo' => [
        'rules' => 'uploaded[photo]|ext_in[photo,png,jpg,jpeg]',
        'errors' => [
            'uploaded' => 'Photo is required',
            'ext_in' => 'Photo is not an image',
        ],
    ],
  ];

  public $payments_member = [
    'contri_id' => [
        'rules' => 'required|numeric',
        'errors' => [
            'required' => 'Cost is required',
            'numeric' => 'Error in selecting payments',
        ],
    ],
    'amount' => [
        'rules' => 'required|numeric',
        'errors' => [
            'required' => 'Cost is required',
            'numeric' => 'Amount should be in numerical form',
        ],
    ],
	'photo' => [
		'label' => 'Photo', 
		'rules' => 'is_image[photo]',
		'errors' => [
			'is_image' => 'Uploaded file is not an image',
		],
	],
  ];

  public $payment_method = [
    'name' => [
        'rules' => 'required|min_length[5]|max_length[100]|alpha_numeric_space',
        'errors' => [
            'required' => 'Name is required',
        ],
    ],
    'steps' => [
        'rules' => 'required',
        'errors' => [
            'uploaded' => 'Steps to pay is required',
        ],
    ],
	'image' => [
		'label' => 'Image', 
		'rules' => 'is_image[image]',
		'errors' => [
			'is_image' => 'Uploaded file is not an image',
		]
	],
  ];

//   upload membership proof after registering
  public $memberProof = [
    'user_id' => [
        'rules' => 'required|numeric',
    ],
    'proof' => [
        'rules' => 'uploaded[proof]|is_image[proof]',
    ],
  ];

  public $news = [
      'title' => [
          'label' => 'Title', 
          'rules' => 'required|max_length[999]',
          'errors' => [
              'required' => 'Title field is required',
              'min_length' => 'Title field too short',
              'max_length' => 'Title field reached max character length',
          ]
      ],
      'content' => [
          'label' => 'Content', 
          'rules' => 'required',
          'errors' => [
              'required' => 'Content field is required',
          ]
      ],
      'image' => [
          'label' => 'Image', 
          'rules' => 'uploaded[image]|is_image[image]',
          'errors' => [
              'uploaded' => 'No image uploaded',
              'is_image' => 'Uploaded file is not an image',
          ]
      ],
  ];

  public $officers = [
      'pres' => [
          'label' => 'President', 
          'rules' => 'required|numeric',
      ],
      'vpint' => [
          'label' => 'VP Internal', 
          'rules' => 'required|numeric',
      ],
      'vpext' => [
          'label' => 'VP External', 
          'rules' => 'required|numeric',
      ],
      'sect' => [
          'label' => 'Secretary', 
          'rules' => 'required|numeric',
      ],
      'assect' => [
          'label' => 'Assistant Secretary', 
          'rules' => 'required|numeric',
      ],
      'treas' => [
          'label' => 'Treasurer', 
          'rules' => 'required|numeric',
      ],
      'astreas' => [
          'label' => 'Assistant Treasurer', 
          'rules' => 'required|numeric',
      ],
      'audit' => [
          'label' => 'Auditor', 
          'rules' => 'required|numeric',
      ],
      'busMan1' => [
          'label' => 'Business Manager', 
          'rules' => 'required|numeric',
      ],
      'busMan2' => [
          'label' => 'Business Manager', 
          'rules' => 'required|numeric',
      ],
      'pro1' => [
          'label' => 'Public Relations Officer', 
          'rules' => 'required|numeric',
      ],
      'pro2' => [
          'label' => 'Public Relations Officer', 
          'rules' => 'required|numeric',
      ],
  ];

  public $payFeedback = [
    'subject' => [
        'rules' => 'required|max_length[100]',
        'errors' => [
            'required' => 'Subject is required',
            'max_length' => 'Length exceeds, please try again.',
        ],
    ],
    'comment' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'Comment is required',
        ],
    ],
    'subject' => [
        'rules' => 'required|max_length[100]',
        'errors' => [
            'required' => 'Subject is required',
            'max_length' => 'Length exceeds, please try again.',
        ],
    ],
  ];

  public $updatePassword = [
	'current_password' =>[
	  'label' => 'Current Password', 
	  'rules' => 'required|min_length[5]|max_length[30]'
	],
	'new_password' =>[
	  'label' => 'New Password', 
	  'rules' => 'required|regex_match[/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,30}$/]|matches[confirm_new_password]'
	],
	'confirm_new_password' =>[
	  'label' => 'Confirm New Password', 
	  'rules' => 'required|min_length[8]|max_length[30]'
	],
  ];

  public $reset_password = [
	'password' =>[
		'label' => 'Password', 
	  	'rules' => 'required|regex_match[]|matches[confirm_new_password]',
	  	'errors' => [
			'regex_match' => '8-30 characters, One Uppercase, One Number, Special Characters (!@#$%^&*-)',
		],
	],
	'confirm_new_password' =>[
	  'label' => 'Confirm New Password', 
	  'rules' => 'required|min_length[8]|max_length[30]'
	],
  ];

  public $discussion = [
	'subject' => [
		'label' => 'Subject',
		'rules' => 'required',
	],
	'image' => [
		'label' => 'Image', 
		'rules' => 'ext_in[image,png,jpg,jpeg]',
		'errors' => [
			'ext_in' => 'Image uploaded is not an image',
		],
	],
	'init_post' => [
		'label' => 'Initial Post',
		'rules' => 'required',
	]
  ];

//   public $roles = [
// 	'role_name' => [
// 		'label' => 'Role Name', 
// 		'rules' => 'required|min_length[3]|max_length[30]|alpha_numeric_space|is_unique[roles.role_name]',
// 		'errors' => [
// 			'required' => 'Role name is required',
// 			'min_length' => 'Role name too short',
// 			'max_length' => 'Role name exceeds max characters',
// 			'alpha_numeric_space' => 'Role name only accepts alphanumeric characters',
// 			'is_unique' => 'Role already exists'
// 			],
// 		],
// 	];

	public $item_categories = [
		'category_name' => [
			'label' => 'Category Name', 
			'rules' => 'required|min_length[3]|max_length[30]|alpha_numeric_space|is_unique[item_category.category_name]',
			'errors' => [
				'required' => 'Category name is required',
				'min_length' => 'Category name too short',
				'max_length' => 'Category name exceeds max characters',
				'alpha_numeric_space' => 'Category name only accepts alphanumeric characters',
				'is_unique' => 'Category already exists'
			],
		],
	];
	
	public $inventory = [
        'item_name' => [
            'label' => 'Item Name',
            'rules' => 'required|alpha_numeric_space',
            'errors' => [
                'required' => 'Name is required',
                'alpha_numeric_space' => 'Name includes invalid symbols',
            ],
        ],
        'date_purchased' => [
            'label' => 'Date',
            'rules' => 'required',
        ],
		'cost' => [
            'label' => 'Cost',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Cost is required',
                'numeric' => 'Cost only includes numbers',
            ],
        ],
        'category_id' => [
            'label' => 'Category',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Category is required',
            ],
        ],
	];
  
}
