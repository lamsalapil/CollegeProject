#include<stdio.h>
#include<conio.h>
#include<string.h>
#include<windows.h>

struct date
{
	int day;
	int month;
	int year;
};

			//function prototype
void registeruser();     
void login();
int generateid();
int generateac_no();
void view_customer();
void view_transaction();
void remove_customer();
void view_information();
void amtdeposit(int ac_no);
void updated();
void balance_check();
void withdrawl(int ac_no);
void transactions();


struct details
{

	char fname[30],lname[30],username[20], password[20];
	char adress[50],gender[10];
	int id,age,day, month, year;
	long int phone;
	long int ac_no;
	float balance;
	char role;
};
void fordelay(int j)
{   int i,k;
    for(i=0;i<j;i++)
         k=i;
}

int main()
{
    char pass[10],password[10]="MUBMS";
    int i=0;
    printf("\n\n\t\tEnter login password:");
    scanf("%s",pass);
   
    if (strcmp(pass,password)==0)
        {printf("\n\nPassword Match!\nLOADING");
        for(i=0;i<=6;i++)
        {
            fordelay(10);
            printf(">");
        }
                system("cls");
            	firstmain();
        }
    else
         printf("\n\nWrong password!!\a\a\a");
   
        return 0;
}



int firstmain()
{
	
	int choice;
	do
	{
		system("cls");
		printf("\n\n\t\t\t\tMalaysian Urban Bank Management System (MUBMS)");
		printf("\n========================================================================================================================\n\n");
		printf("\t\t\t0:\tExit.:\n");
		printf("\n\t\t\t1:\tRegister.:\n");
		printf("\n\t\t\t2:\tLogin.:\n");
		printf("\n\n\nWhich operation do you want to perform?\n");
		scanf("%d",&choice); fflush(stdin);
		switch(choice)
		{
			case 0: printf("\nThank you.\n"); getch(); return 0;
			case 1: registeruser(); break;
			case 2: login(); break;
			default: printf("\nInvalid choice. Enter [0-2]\n\n"); getch();
		}
		
    }while(1);

}

void registeruser()
{
	SYSTEMTIME stime;
    GetSystemTime(&stime);
	char fname[30],lname[30],username[20], password[20];
	char adress[50],gender[10];
	int id,age,day, month, year;
	long int phone;
	long int ac_no;
	float balance;
	char role;
	FILE *fp;
	 
	fp= fopen("Details.txt","a");
	if(fp==NULL)
	{
		printf("\nFILE could notbe opened!\n"); getch(); return ;
	}
	printf("Enter your details:\n--------------------\n");
	id=generateid();
	ac_no=generateac_no();
	printf("\nEnter First Name:"); gets(fname); fflush(stdin);
	printf("\nEnter Last Name:"); gets(lname); fflush(stdin);
	printf("\nEnter Your age:"); scanf("%d",&age); fflush(stdin);
	printf("\nGender:"); gets(gender); fflush(stdin);
	printf("\nEnter Username:"); gets(username); fflush(stdin);
	printf("\nCreate Password:"); gets(password); fflush(stdin);
	printf("\nEnter Phone:"); scanf("%ld",&phone); fflush(stdin);
	printf("\nEnter Your Address:"); gets(adress); fflush(stdin);
	printf("\nYour Role:"); scanf("%c",&role); fflush(stdin);
	
	printf("\nBalance:"); scanf("%f",&balance); fflush(stdin);
	
	fprintf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d\n",id,ac_no,fname,lname,age,gender,username,password,phone,adress,role,balance,stime.wDay,stime.wMonth,stime.wYear);
	fclose(fp);
	printf("\n\nData written successfully in file!!"); getch();	
	
	
} 


void login()
{	
	SYSTEMTIME stime;
    GetSystemTime(&stime);
     struct details user;
	 char un[20], p[20];
	 
     FILE *fp;
     fp = fopen("Details.txt", "r");
     
     if(fp==NULL)
     {
        printf("\nFIle could not be opened!\n"); getch(); return;
     }
     
     
     printf("\nEnter username:\n");    gets(un); fflush(stdin);
     printf("\nEnter password:\n");    gets(p); fflush(stdin);

     while(fscanf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",&user.id,&user.ac_no,user.fname,user.lname,&user.age,user.gender,user.username,user.password,&user.phone,user.adress,&user.role,&user.balance,&stime.wDay,&stime.wMonth,&stime.wYear) == 15)
	   
	 {
        if(strcmp(un, user.username) == 0 && strcmp(p, user.password) == 0 )
        {
			fclose(fp);    			//role verification
			if(user.role=='a')
			 adminmenu();
			else
			 customermenu();
			
			return;
        }
     }
     fclose(fp);
     printf("\nLogin failed!!"); getch();
     main();
}


int generateid()  
{
	SYSTEMTIME stime;
	GetSystemTime(&stime);
	struct details user;
	FILE *fp;
	int no=0;
	fp=fopen("Details.txt","r");
	while(fscanf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",&user.id,&user.ac_no,user.fname,user.lname,&user.age,user.gender,user.username,user.password,&user.phone,user.adress,&user.role,&user.balance,&stime.wDay,&stime.wMonth,&stime.wYear) == 15)
	{
		if(no<user.id)
		{
			no=user.id;
		}
	}
	fclose(fp);
	return no+1;
}


int generateac_no()  
{
	SYSTEMTIME stime;
	GetSystemTime(&stime);
	struct details user;
	int acc=20760225;
	
	FILE *fp;
	fp=fopen("Details.txt","r");
	while(fscanf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",&user.id,&user.ac_no,user.fname,user.lname,&user.age,user.gender,user.username,user.password,&user.phone,user.adress,&user.role,&user.balance,&stime.wDay,&stime.wMonth,&stime.wYear) == 15)
	{
		if(acc<user.ac_no)
		{
			acc=user.ac_no;
		}
	}
	fclose(fp);
	return acc+5;
}

int adminmenu()
{
  int choice;
  do
  {
  
	  system("cls");
	  printf("\n\t\t\t\t-------------<<<<ADMIN MENU>>>>-------------");
	  printf("\n========================================================================================================================\n");
	  printf("\t\t0:\tLogout\n");
	  printf("\n\t\t1:\tView Customer list\n");
	  printf("\n\t\t2:\tView Last transaction\n");
	  printf("\n\t\t3:\tRemove existing Customer\n\n");
	  printf("\nWhich operation to perform?\n");
	  scanf("%d", &choice); fflush(stdin);
	  switch (choice)
		  {
		  	case 0:printf("\nThank for using this application.");getch(); return 0;
		  	case 1:view_customer();break;
		  	case 2:view_transaction();break;
		  	case 3:remove_customer();break;
		  	default:printf("\nInvalid. Enter [0-3]\n\n"); getch(); return 0;
		  	
		  }
	}while(1);
  
}


int customermenu()
{
  long int ac_no;
  int choice;
  do
  {
	  system("cls");
	  printf("\n\t\t\t\t-------------<<<<COSTUMER MENU>>>>-------------");
	  printf("\n========================================================================================================================\n");
	  printf("\t\t0:\tLogout\n");
	  printf("\n\t\t1:\tView personal Information\n");
	  printf("\n\t\t2:\tDeposit\n");
	  printf("\n\t\t3:\tWithdrawl\n");
	  printf("\n\t\t4:\tView Last Transactions\n");
	  printf("\n\t\t5:\tUpdate Your Information\n");
	  printf("\nWhich operation to perform?\n");
	  scanf("%d", &choice); fflush(stdin);
	  switch(choice)
		  {
		  	case 0:printf("\nThank for using this application.");getch(); return 0;
		  	case 1:view_information();break;
		  	case 2:amtdeposit(ac_no);break;
		  	case 3:withdrawl(ac_no);break;
		  	case 4:transactions();break;
		  	case 5:updated(); break;
		  	default:printf("\nInvalid. Enter [0-4]\n\n"); getch(); return 0;
		  }
	}while(1);
}



void view_customer()
{
	
	struct details user;
	struct date de;
	long int acc_no;
	
	printf("\nEnter Your Account Number:\n "); scanf("%ld",&acc_no); fflush(stdin);
	FILE *fp;
	fp=fopen("Details.txt","r");
	system("cls");

	while(fscanf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",&user.id,&user.ac_no,user.fname,user.lname,&user.age,user.gender,user.username,user.password,&user.phone,user.adress,&user.role,&user.balance,&de.day,&de.month,&de.year) == 15)
	{
		if (acc_no== user.ac_no) 
	
		{
			printf("\n------------------------------------------------------------------------------------------------------------------------\n");
			printf("\n\t\t<<<<<<%s%s Information>>>>>>", user.fname,user.lname);
			printf("\n------------------------------------------------------------------------------------------------------------------------\n");
			printf("\nCustomer ID: %d",user.id);
			printf("\nAccount Nummber: %ld",user.ac_no);
			printf("\nName: %s %s", user.fname,user.lname);			
			printf("\nGender: %s", user.gender); 
			printf("\nUSERNAME: %s",user.username); 
			printf("\nPASSWORD: %s",user.password); 
			printf("\nPhone Number: %ld",user.phone); 
			printf("\nAddress:%s",user.adress);
			printf("\nRole:%c",user.role);
			printf("\nCurrent balance:%f",user.balance);
			printf("\nDate of Joining(Day-month-year): %d-%d-%d",de.day,de.month,de.year);
			printf("\n------------------------------------------------------------------------------------------------------------------------\n");
		}
	}
	fclose(fp);
	getch();

}



void view_transaction()
{
	
		 FILE *fptr; 
  
    char c; 
  	

    // Open file 
    fptr = fopen("transactionlog.txt", "r"); 
    if (fptr == NULL) 
    { 
        printf("Cannot open file \n"); 
        exit(0); 
    } 
  
    // Read contents from file 
    c = fgetc(fptr); 
    while (c != EOF) 
    { 
        printf ("%c", c); 
        c = fgetc(fptr); 
    } 
  
    fclose(fptr); 
	
	getch();	
}


void remove_customer(struct details list[], int count)
{

	
	char fname[30],lname[30],username[20], password[20];
	char adress[50],gender[10];
	int id,age,day, month, year;
	long int phone;
	long int ac_no;
	float balance;
	char role;
	struct date de;
	char pw[20];
	int i;
	long int acc_no;
	system("cls");
	printf("\n\n\t\t\t<<<<<<____Remove Menu____>>>>>>\n");
	FILE *fp;
	fp =fopen("Details.txt","a");

	printf("\nEnter Account Number:\n");
	scanf("%ld",&acc_no); fflush(stdin);
	for(i=0;i<count;i++)
	{
		if(list[i].ac_no=ac_no)
		{
			for(i=i+1;i<count;i++);
			{
				list[i-1]=list[i];
			}
		}count--;
		break;
		
	}
	for(i=0;i<count;i++)
	{
		fprintf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",id,ac_no,fname,lname,age,gender,username,password,phone,adress,role,balance,de.day,de.month,de.year);
	}
	printf("\n\nRemove Sucessfully!!");fflush(stdin);
	fclose(fp);
}
    
    

void view_information()
{

	char pw[20];
	struct details user;
	struct date de;
	printf("\nEnter password:\n"); gets(pw); fflush(stdin);
	FILE *fp;
	fp=fopen("Details.txt","r");
	system("cls");

	while(fscanf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",&user.id,&user.ac_no,user.fname,user.lname,&user.age,user.gender,user.username,user.password,&user.phone,user.adress,&user.role,&user.balance,&de.day,&de.month,&de.year) == 15)
	{
		if (strcmp(pw, user.password) == 0)
		{
			printf("\n\n------------------------------------------------------------------------------------------------------------------------\n");
			printf("\t\tPersonal Account");
			printf("\n------------------------------------------------------------------------------------------------------------------------\n");
			printf("\n\tCustomer ID: %d",user.id);
			printf("\n\tAccount Nummber: %ld",user.ac_no);
			printf("\n\tName: %s %s", user.fname,user.lname);			
			printf("\n\tUSERNAME: %s",user.username);  
			printf("\n\tPhone Number: %ld",user.phone); 
			printf("\n\tAddress:%s",user.adress);
			printf("\n\tCurrent balance:%f",user.balance);
			printf("\n\tDate of Joining(Day-month-year):%d-%d-%d",de.day,de.month,de.month);
			printf("\n\n------------------------------------------------------------------------------------------------------------------------\n");
		}
	}
	fclose(fp);
	getch();	
}

void amtdeposit(int ac_no)
{
	SYSTEMTIME stime;
    GetSystemTime(&stime);
	
	char pw;
	int tranid;
	struct date de;
	struct details user;
	
	float deposit;
	system("cls");
	FILE *fp;
	FILE *fp1;
	FILE *fp2;
	FILE *fp3;
	
	fp = fopen("Details.txt","r");
	fp1 = fopen("transaction.txt","a");
	fp2 = fopen("transactionlog.txt","a");
	printf("\nDeposit Amount\n");
	fflush(stdin);
	

	while(fscanf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",&user.id,&user.ac_no,user.fname,user.lname,&user.age,user.gender,user.username,user.password,&user.phone,user.adress,&user.role,&user.balance,&de.day,&de.month,&de.year) == 15)
		{
			
		printf("\nYour Transaction Id %d \n",tranid);
		printf("Enter amount:\n");
		scanf("%f",&deposit); 
		fprintf(fp2,"%d %ld ,%s %s has been deposited amount Rs: %f on %d-%d-%d\n ",tranid, user.ac_no,user.fname,user.lname,deposit,stime.wDay,stime.wMonth,stime.wYear);
		user.balance=user.balance+deposit;
		
		fprintf(fp1,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",user.id,user.ac_no,user.fname,user.lname,user.age,user.gender,user.username,user.password,user.phone,user.adress,user.role,user.balance,de.day,de.month,de.year);
		printf("Your New Balance is %f",user.balance);
		printf("\n\nDeposited successfully!");
		}
		
		fclose(fp);
		fclose(fp1);
		fclose(fp2);
		remove("Details.txt");
   		rename("transaction.txt","Details.txt");
		getch();
}


void withdrawl(int ac_no)
{
	SYSTEMTIME stime;
    GetSystemTime(&stime);
	
	char pw;
	int tranid;
	struct date de;
	struct details user;
	system("cls");
	float withdraw;
	
	FILE *fp;
	FILE *fp1;
	FILE *fp2;
	FILE *fp3;
	
	fp = fopen("Details.txt","r");
	fp1 = fopen("transaction.txt","a");
	fp2 = fopen("transactionlog.txt","a");
	printf("\nWithDraw Amount\n");
	fflush(stdin);


	while(fscanf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",&user.id,&user.ac_no,user.fname,user.lname,&user.age,user.gender,user.username,user.password,&user.phone,user.adress,&user.role,&user.balance,&de.day,&de.month,&de.year) == 15)
		{
			
		printf("\nYour Transaction Id %d \n",tranid);
		printf("Enter amount:\n");
		scanf("%f",&withdraw); 
		fprintf(fp2,"%d %ld ,%s %s  WithDraw amount Rs: %f on %d-%d-%d\n ",tranid, user.ac_no,user.fname,user.lname,withdraw,stime.wDay,stime.wMonth,stime.wYear);
		user.balance=user.balance-withdraw;
	
	
		fprintf(fp1,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",user.id,user.ac_no,user.fname,user.lname,user.age,user.gender,user.username,user.password,user.phone,user.adress,user.role,user.balance,de.day,de.month,de.year);
		printf("Your New Balance is %f",user.balance);
		printf("\n\nWithdraw action successful!");
		}
		
		fclose(fp);
		fclose(fp1);
		fclose(fp2);

		remove("Details.txt");
   		rename("transaction.txt","Details.txt");
		getch();
}


void transactions()
{
	 FILE *fptr; 
  
    char c; 
  
    // Open file 
    fptr = fopen("transactionlog.txt", "r"); 
    if (fptr == NULL) 
    { 
        printf("Cannot open file \n"); 
        exit(0); 
    } 
  
    // Read contents from file 
    c = fgetc(fptr); 
    while (c != EOF) 
    { 
        printf ("%c", c); 
        c = fgetc(fptr); 
    } 
  
    fclose(fptr);
	getch();	

}


void updated()
{
	struct details user;
	struct date de;
	int choice, test=0;
	char pw[30];
	SYSTEMTIME stime;
    GetSystemTime(&stime);
    printf("\nEnter password:\n"); gets(pw); fflush(stdin);
	FILE *fp, *fp1;
	fp=fopen("details.txt","r");
	fp1=fopen("update.txt","w");
	system("cls");
	while(fscanf(fp,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",&user.id,&user.ac_no,user.fname,user.lname,&user.age,user.gender,user.username,user.password,&user.phone,user.adress,&user.role,&user.balance,&de.day,&de.month,&de.year) == 15)
	{
		if (strcmp(pw, user.password) == 0)
		{
			test=1;
			printf("\nWhich information do you want to change?\n1. New First name\n2. New last name\n3. Gender\n4. New Username\n5. New Address\n6. New Phone Number\n\n\n Enter your choice(1-5): ");
			scanf("%d",&choice); fflush(stdin);
			system("cls");
			if(choice==1)
			{
				printf("\nEnter  New First Name:"); gets(user.fname); fflush(stdin);
			}
			else if(choice==2)
			{
				printf("\nEnter New Last Name:"); gets(user.lname); fflush(stdin);	
			}
			else if(choice==3)
			{
				printf("\nGender:"); gets(user.gender); fflush(stdin);	
			}
			else if(choice==4)
			{
				printf("\nEnter New Username:"); gets(user.username); fflush(stdin);
			}
			else if(choice==5)
			{
				printf("\nYour Address:"); gets(user.adress); fflush(stdin);
			}
			else if(choice==6)
			{
				printf("Enter the new phone number: ");
				scanf("%ld",&user.phone); fflush(stdin);	
			}
			fprintf(fp1,"%d %ld %s %s %d %s %s %s %ld %s %c %f %d %d %d",user.id,user.ac_no,user.fname,user.lname,user.age,user.gender,user.username,user.password,user.phone,user.adress,user.role,user.balance,stime.wDay,stime.wMonth,stime.wYear);
			system("cls");
			printf("\nNEW DATA SAVED\n Thank you!!"); getch();
		
		}
		fclose(fp1);
	}
	fclose(fp);
	remove("details.txt");
	rename("update.txt","details.txt");
	getch();
}



















